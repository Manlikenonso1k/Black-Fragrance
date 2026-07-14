<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderPaymentRefreshService
{
    public function refresh(Order $order): array
    {
        if ($order->payment_gateway !== 'tgipay') {
            return [
                'ok' => false,
                'message' => 'Payment refresh is only available for TGI Pay orders.',
            ];
        }

        $reference = trim((string) $order->order_number);

        if ($reference === '') {
            return [
                'ok' => false,
                'message' => 'No transaction reference is available for this order.',
            ];
        }

        $response = Http::withHeaders([
            'integration-key' => config('services.tgipay.integration_key'),
        ])
            ->acceptJson()
            ->timeout(30)
            ->get(rtrim((string) config('services.tgipay.base_url'), '/') . '/payment/status/' . rawurlencode($reference));

        if (! $response->ok()) {
            Log::warning('TGI Pay payment status lookup failed', [
                'order_id' => $order->id,
                'reference' => $reference,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'ok' => false,
                'message' => 'Could not verify payment status right now.',
            ];
        }

        $payload = $response->json() ?? [];
        $status = $this->normalizeStatus($this->extractStatus($payload));

        if ($status !== 'success') {
            return [
                'ok' => false,
                'message' => 'Payment status is ' . ($status !== '' ? $status : 'unknown') . ' for this reference.',
            ];
        }

        DB::transaction(function () use ($order, $reference): void {
            $updates = [
                'payment_status' => 'success',
                'status' => 'processing',
                'payment_ref' => $reference,
            ];

            if ($order->payment_status !== 'success' || blank($order->payment_ref)) {
                $order->forceFill($updates)->save();
            }
        });

        $order->refresh();

        return [
            'ok' => true,
            'message' => 'Payment confirmed for order ' . $order->order_number . '.',
        ];
    }

    private function extractStatus(array $payload): string
    {
        $candidates = [
            data_get($payload, 'data.status'),
            data_get($payload, 'status'),
            data_get($payload, 'body.data.status'),
            data_get($payload, 'body.status'),
        ];

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && trim($candidate) !== '') {
                return trim($candidate);
            }
        }

        return '';
    }

    private function normalizeStatus(string $status): string
    {
        return match (strtolower(trim($status))) {
            'success', 'successful', 'completed', 'paid' => 'success',
            'failed', 'cancelled', 'canceled' => 'failed',
            'processing', 'pending', 'awaiting_payment', 'awaiting payment' => 'processing',
            default => trim(strtolower($status)),
        };
    }
}
