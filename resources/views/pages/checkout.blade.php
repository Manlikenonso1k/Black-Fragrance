@extends('layouts.app')

@section('content')
<style>
    .checkout-page {
        --mono-black: #000000;
        --mono-white: #ffffff;
        --mono-gray-100: #f5f5f5;
        --mono-gray-200: #e0e0e0;
        --mono-gray-700: #333333;
        --mono-gray-500: #666666;
        --serif: "Cormorant Garamond", Georgia, serif;
        --sans: "Inter", sans-serif;
        font-family: var(--sans);
        color: var(--mono-gray-700);
        padding: 54px 0;
    }

    .checkout-page .page-title {
        font-family: var(--serif);
        font-size: 36px;
        color: var(--mono-black);
        margin-bottom: 20px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 36px;
    }

    .checkout-form {
        border: 1px solid var(--mono-gray-200);
        border-radius: 4px;
        background: var(--mono-white);
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .checkout-form label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--mono-gray-700);
    }

    .checkout-form input,
    .checkout-form select,
    .checkout-form textarea {
        width: 100%;
        border: 1px solid var(--mono-gray-200);
        border-radius: 4px;
        padding: 12px 14px;
        font-size: 14px;
        background: var(--mono-white);
        font-family: var(--sans);
    }
    
    .checkout-form textarea {
        resize: vertical;
        min-height: 80px;
    }

    .summary {
        position: sticky;
        top: 20px;
        border: 1px solid var(--mono-gray-200);
        border-radius: 4px;
        background: var(--mono-gray-100);
        padding: 24px;
        height: fit-content;
    }

    .summary h3 {
        margin: 0 0 20px;
        font-family: var(--serif);
        color: var(--mono-black);
        font-size: 26px;
    }
    
    .summary-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--mono-gray-200);
    }
    
    .summary-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid var(--mono-gray-200);
    }
    
    .summary-item-details {
        flex: 1;
    }
    
    .summary-item-details h4 {
        margin: 0 0 4px;
        font-family: var(--serif);
        font-size: 18px;
        color: var(--mono-black);
    }
    
    .summary-item-details p {
        margin: 0;
        font-size: 12px;
        color: var(--mono-gray-500);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .summary-row.total {
        border-top: 1px solid var(--mono-gray-200);
        padding-top: 16px;
        margin-top: 16px;
        font-weight: 700;
        font-size: 18px;
        color: var(--mono-black);
    }

    .solid-btn {
        border-radius: 4px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 20px;
        border: 1px solid var(--mono-black);
        background: var(--mono-black);
        color: var(--mono-white);
        width: 100%;
        cursor: pointer;
        transition: background 0.2s ease;
        margin-top: 20px;
        font-weight: 600;
    }
    
    .solid-btn:hover {
        background: var(--mono-gray-700);
    }
    
    .text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
    }

    @media (max-width: 992px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
        .summary {
            position: static;
        }
    }
    
    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="checkout-page">
    <div class="container">
        <h1 class="page-title">Checkout</h1>
        
        @if($errors->any())
            <div style="padding: 15px; background-color: #f8d7da; color: #721c24; margin-bottom: 24px; border-radius: 4px;">
                <ul style="margin:0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="checkout-grid">
            <div class="checkout-form">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <h3 style="font-family: var(--serif); margin-top: 0; margin-bottom: 20px; font-size: 24px;">Customer Details</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    
                    <h3 style="font-family: var(--serif); margin-top: 20px; margin-bottom: 20px; font-size: 24px;">Shipping Details</h3>
                    
                    <div class="form-group">
                        <label for="address">Street Address *</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City *</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State / Province *</label>
                            <input type="text" id="state" name="state" value="{{ old('state') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="postal_code">Postal / Zip Code *</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country *</label>
                            <select id="country" name="country" required>
                                <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Order Notes (Optional)</label>
                        <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                    </div>
                    
                    <button type="submit" class="solid-btn" style="font-size: 14px;">Pay ₦{{ number_format($total ?? 0, 2) }} with TGI Pay</button>
                </form>
            </div>

            <aside class="summary">
                <h3>Your Order</h3>
                
                <div style="max-height: 350px; overflow-y: auto; margin-bottom: 20px;">
                    @foreach($items as $item)
                        <div class="summary-item">
                            <img src="{{ $item->product->image ?? asset('images/selling-products4.jpg') }}" alt="{{ $item->product->name }}">
                            <div class="summary-item-details">
                                <h4>{{ $item->product->name }}</h4>
                                <p>Qty: {{ $item->quantity }} @if($item->variant) | {{ $item->variant->name }} @endif</p>
                                <p style="font-weight: 600; color: var(--mono-black); margin-top: 4px;">₦{{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="summary-row"><span>Subtotal</span><span>₦{{ number_format($total ?? 0, 2) }}</span></div>
                <div class="summary-row"><span>Shipping</span><span>Calculated at next step</span></div>
                <div class="summary-row total"><span>Total</span><span>₦{{ number_format($total ?? 0, 2) }}</span></div>
            </aside>
        </div>
    </div>
</section>
@endsection
