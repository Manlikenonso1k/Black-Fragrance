@extends('layouts.app')

@section('content')
<style>
    .success-page {
        padding: 80px 0;
        text-align: center;
        --mono-black: #000000;
        --mono-white: #ffffff;
        --mono-gray-100: #f5f5f5;
        --mono-gray-200: #e0e0e0;
        --mono-gray-700: #333333;
        --mono-gray-500: #666666;
        --serif: "Cormorant Garamond", Georgia, serif;
        --sans: "Inter", sans-serif;
        font-family: var(--sans);
    }
    
    .success-icon {
        width: 80px;
        height: 80px;
        background: var(--mono-black);
        color: var(--mono-white);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin-bottom: 24px;
    }
    
    .success-page h1 {
        font-family: var(--serif);
        font-size: 42px;
        color: var(--mono-black);
        margin-bottom: 12px;
    }
    
    .success-page p {
        color: var(--mono-gray-700);
        margin-bottom: 30px;
        font-size: 16px;
    }
    
    .order-details {
        max-width: 600px;
        margin: 0 auto 40px;
        text-align: left;
        border: 1px solid var(--mono-gray-200);
        border-radius: 4px;
        padding: 30px;
        background: var(--mono-white);
    }
    
    .order-details h3 {
        font-family: var(--serif);
        font-size: 24px;
        margin-top: 0;
        border-bottom: 1px solid var(--mono-gray-200);
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }
    
    .detail-row.total {
        border-top: 1px solid var(--mono-gray-200);
        padding-top: 15px;
        margin-top: 15px;
        font-weight: 700;
        font-size: 18px;
    }
    
    .solid-btn {
        border-radius: 4px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 30px;
        border: 1px solid var(--mono-black);
        background: var(--mono-black);
        color: var(--mono-white);
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        transition: background 0.2s ease;
    }
    
    .solid-btn:hover {
        background: var(--mono-gray-700);
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-badge.success {
        background: #d4edda;
        color: #155724;
    }
    
    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }
</style>

<section class="success-page">
    <div class="container">
        @if($order->payment_status === 'success')
            <div class="success-icon">✓</div>
            <h1>Thank You for Your Order!</h1>
            <p>Your payment was successful and your order is now being processed.</p>
        @else
            <div class="success-icon" style="background: #ffc107;">!</div>
            <h1>Order Received</h1>
            <p>We've received your order, but payment is still pending. We'll update you once confirmed.</p>
        @endif
        
        <div class="order-details">
            <h3>Order Information</h3>
            <div class="detail-row">
                <span style="color: var(--mono-gray-500);">Order Number</span>
                <span style="font-weight: 600;">{{ $order->order_number }}</span>
            </div>
            <div class="detail-row">
                <span style="color: var(--mono-gray-500);">Date</span>
                <span>{{ $order->created_at->format('M d, Y') }}</span>
            </div>
            <div class="detail-row">
                <span style="color: var(--mono-gray-500);">Payment Status</span>
                <span class="status-badge {{ $order->payment_status === 'success' ? 'success' : 'pending' }}">
                    {{ $order->payment_status === 'success' ? 'Paid' : 'Pending' }}
                </span>
            </div>
            <div class="detail-row">
                <span style="color: var(--mono-gray-500);">Customer</span>
                <span>{{ $order->first_name }} {{ $order->last_name }}</span>
            </div>
            <div class="detail-row">
                <span style="color: var(--mono-gray-500);">Email</span>
                <span>{{ $order->email }}</span>
            </div>
            
            <div class="detail-row total">
                <span>Total Amount</span>
                <span>₦{{ number_format($order->total, 2) }}</span>
            </div>
        </div>
        
        <a href="{{ route('shop') }}" class="solid-btn">Continue Shopping</a>
    </div>
</section>
@endsection
