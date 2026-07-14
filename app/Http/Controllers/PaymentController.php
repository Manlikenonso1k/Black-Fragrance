<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Initiate a TGI Pay payment and redirect the customer to TGI Pay's hosted page.
     * GET/POST /checkout/pay/tgipay/{order}
     */
    public function initiateTgiPay(Order $order)
    {
        // Prevent re-paying completed orders
        if ($order->payment_status === 'success') {
            return redirect()->route('order.success', $order)->with('info', 'Order already paid.');
        }

        // Amount is sent as actual naira float
        $amount = (float) $order->total;

        $order->update([
            'payment_gateway' => 'tgipay',
            'payment_status' => 'pending',
        ]);

        $payload = [
            'customerFirstName'  => $order->first_name,
            'customerLastName'   => $order->last_name,
            'customerEmail'      => $order->email,
            'amount'             => $amount,
            'transactionReference' => $order->order_number,
            'currency'           => 'NGN',
        ];

        $response = Http::withHeaders([
            'integration-key' => config('services.tgipay.integration_key'),
        ])
            ->acceptJson()
            ->timeout(30)
            ->post(config('services.tgipay.base_url') . '/payment/initiate', $payload);

        if (!$response->ok()) {
            Log::error('TGI Pay initiation failed', ['response' => $response->body()]);
            return redirect()->route('checkout')->with('error', 'Could not initiate payment. Please try again.');
        }

        $paymentUrl = data_get($response->json(), 'body.data.url')
                   ?? data_get($response->json(), 'data.url')
                   ?? data_get($response->json(), 'url');

        if (!$paymentUrl) {
            Log::error('TGI Pay: no payment URL found in response', ['json' => $response->json()]);
            return redirect()->route('checkout')->with('error', 'Gateway did not return a payment URL.');
        }

        return redirect()->away($paymentUrl);
    }

    /**
     * TGI Pay redirects the customer here after payment.
     * ANY /tgipay/callback?ref=...&status=...
     */
    public function tgiPayCallback(Request $request)
    {
        $ref    = (string) $request->input('ref', '');
        $status = (string) $request->input('status', 'processing');

        $internalStatus = match (strtolower($status)) {
            'success', 'successful', 'completed', 'paid' => 'success',
            'failed', 'cancelled', 'canceled'             => 'failed',
            default                                        => 'processing',
        };

        $order = Order::where('order_number', $ref)->first();

        if (!$order) {
            Log::warning('TGI Pay callback: order not found', ['ref' => $ref]);
            return redirect('/')->with('error', 'Order not found.');
        }

        if ($internalStatus !== 'success') {
            return redirect()->route('checkout')->with('error', 'Payment was not completed.');
        }

        if ($order->payment_status !== 'success') {
            $order->update([
                'payment_status' => 'success',
                'status' => 'processing', // Order is now processing
                'payment_ref' => $ref,
            ]);
            
            // Clear cart upon successful payment
            if ($order->user_id) {
                Cart::where('user_id', $order->user_id)->delete();
            } else {
                Cart::where('session_id', session()->getId())->delete();
            }

            // TODO: Trigger order confirmation email
        }

        return redirect()->route('order.success', $order);
    }

    /**
     * TGIPay Background Webhook.
     * POST /webhooks/tgi
     */
    public function tgiPayWebhook(Request $request)
    {
        $ref    = (string) $request->input('ref', '');
        $status = (string) $request->input('status', 'processing');

        $internalStatus = match (strtolower($status)) {
            'success', 'successful', 'completed', 'paid' => 'success',
            'failed', 'cancelled', 'canceled'             => 'failed',
            default                                        => 'processing',
        };

        if ($internalStatus !== 'success') {
            return response()->json(['message' => 'Status not successful, ignored'], 200);
        }

        $order = Order::where('order_number', $ref)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->payment_status !== 'success') {
            $order->update([
                'payment_status' => 'success',
                'status' => 'processing',
                'payment_ref' => $ref,
            ]);
            
            if ($order->user_id) {
                Cart::where('user_id', $order->user_id)->delete();
            } else {
                // Background process, session isn't available for guest carts, but the order is marked paid.
            }

            // TODO: Trigger order confirmation email
        }

        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
