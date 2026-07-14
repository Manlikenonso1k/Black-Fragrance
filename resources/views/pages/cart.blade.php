@extends('layouts.app')

@section('content')
    <style>
        .cart-page {
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
        }

        .cart-page .site-banner {
            border-bottom: 1px solid var(--mono-gray-200);
        }

        .cart-page .page-title {
            font-family: var(--serif);
            letter-spacing: 0.5px;
        }

        .cart-progress {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 28px 0 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .cart-progress .step {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .cart-progress .circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 1px solid var(--mono-gray-200);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            line-height: 1;
            color: var(--mono-gray-500);
            background: var(--mono-white);
        }

        .cart-progress .step.active .circle {
            background: var(--mono-black);
            color: var(--mono-white);
            border-color: var(--mono-black);
        }

        .cart-progress .line {
            width: 48px;
            height: 1px;
            background: var(--mono-gray-200);
        }

        .cart-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 36px;
            padding: 54px 0;
        }

        .cart-list {
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            background: var(--mono-white);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 104px minmax(0, 1fr);
            gap: 18px;
            padding: 20px;
            border-bottom: 1px solid var(--mono-gray-200);
        }

        .cart-item:last-child {
            border-bottom: 0;
        }

        .cart-thumb {
            width: 104px;
            height: 104px;
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            object-fit: cover;
            background: var(--mono-gray-100);
        }

        .cart-item h3 {
            margin: 0 0 6px;
            font-family: var(--serif);
            font-size: 28px;
            line-height: 1;
            color: var(--mono-black);
        }

        .variant {
            margin: 0 0 12px;
            font-size: 13px;
            color: var(--mono-gray-500);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .cart-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }

        .price {
            font-weight: 600;
            color: var(--mono-black);
        }

        .qty {
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            overflow: hidden;
        }

        .qty button {
            border: 0;
            background: var(--mono-white);
            width: 28px;
            height: 28px;
            line-height: 1;
            color: var(--mono-gray-700);
            cursor: pointer;
        }

        .qty span {
            width: 32px;
            text-align: center;
            font-size: 12px;
            border-left: 1px solid var(--mono-gray-200);
            border-right: 1px solid var(--mono-gray-200);
            display: inline-block;
            line-height: 28px;
        }

        .text-link {
            border: 0;
            background: transparent;
            color: var(--mono-gray-500);
            padding: 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            cursor: pointer;
        }

        .save {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--mono-gray-500);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .promo {
            border-top: 1px solid var(--mono-gray-200);
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
        }

        .promo input,
        .summary input,
        .summary select {
            width: 100%;
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 13px;
            background: var(--mono-white);
        }

        .ghost-btn,
        .solid-btn {
            border-radius: 4px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 11px 16px;
            cursor: pointer;
        }

        .ghost-btn {
            border: 1px solid var(--mono-gray-200);
            background: var(--mono-white);
            color: var(--mono-gray-700);
        }

        .solid-btn {
            border: 1px solid var(--mono-black);
            background: var(--mono-black);
            color: var(--mono-white);
            width: 100%;
        }

        .summary {
            position: sticky;
            top: 20px;
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            background: var(--mono-gray-100);
            padding: 20px;
            height: fit-content;
        }

        .summary h3 {
            margin: 0 0 16px;
            font-family: var(--serif);
            color: var(--mono-black);
            font-size: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-row.total {
            border-top: 1px solid var(--mono-gray-200);
            padding-top: 12px;
            margin-top: 12px;
            font-weight: 700;
            color: var(--mono-black);
        }

        .summary .shipping {
            margin: 20px 0;
            padding-top: 16px;
            border-top: 1px solid var(--mono-gray-200);
        }

        .summary label {
            display: block;
            margin: 0 0 6px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--mono-gray-500);
        }

        .upsell {
            padding: 24px 0 56px;
        }

        .upsell h2 {
            font-family: var(--serif);
            color: var(--mono-black);
            margin-bottom: 18px;
            font-size: 36px;
        }

        .upsell-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .upsell-card {
            border: 1px solid var(--mono-gray-200);
            border-radius: 4px;
            background: var(--mono-white);
            padding: 12px;
        }

        .upsell-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .upsell-card h4 {
            margin: 0;
            font-size: 16px;
            color: var(--mono-black);
        }

        .upsell-card p {
            margin: 4px 0 10px;
            font-size: 13px;
        }

        @media (max-width: 992px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }

            .upsell-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .cart-item {
                grid-template-columns: 1fr;
            }

            .cart-thumb {
                width: 100%;
                height: 220px;
            }

            .promo {
                grid-template-columns: 1fr;
            }

            .upsell-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="site-banner jarallax min-height300 padding-large cart-page" style="background: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Shopping Cart</h1>
                    <div class="breadcrumbs">
                        <span class="item"><a href="{{ route('home') }}">Home /</a></span>
                        <span class="item">Cart</span>
                    </div>
                    <div class="cart-progress" aria-label="Checkout Progress">
                        <span class="step active"><span class="circle">1</span>Cart</span>
                        <span class="line" aria-hidden="true"></span>
                        <span class="step"><span class="circle">2</span>Shipping</span>
                        <span class="line" aria-hidden="true"></span>
                        <span class="step"><span class="circle">3</span>Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cart-page">
        <div class="container">
            @if(session('error'))
                <div style="padding: 10px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div style="padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="cart-grid">
                <div class="cart-list">
                    @if(isset($items) && $items->count() > 0)
                        @foreach($items as $item)
                            <article class="cart-item">
                                <img class="cart-thumb" src="{{ $item->product->image ?? asset('images/selling-products4.jpg') }}" alt="{{ $item->product->name }}">
                                <div>
                                    <h3>{{ $item->product->name }}</h3>
                                    @if($item->variant)
                                        <p class="variant">Variant: {{ $item->variant->name }}</p>
                                    @endif
                                    <div class="cart-meta">
                                        <span class="price">₦{{ number_format($item->price, 2) }}</span>
                                        <span class="qty">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;" id="update-form-{{ $item->id }}">
                                                @csrf
                                                <button type="button" onclick="const q=document.getElementById('qty-{{$item->id}}'); if(q.value>1) { q.value--; document.getElementById('update-form-{{ $item->id }}').submit(); }">-</button>
                                                <input type="hidden" name="quantity" id="qty-{{$item->id}}" value="{{ $item->quantity }}">
                                                <span>{{ $item->quantity }}</span>
                                                <button type="button" onclick="const q=document.getElementById('qty-{{$item->id}}'); q.value++; document.getElementById('update-form-{{ $item->id }}').submit();">+</button>
                                            </form>
                                        </span>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-link" type="submit">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div style="padding: 40px; text-align: center;">
                            <h3>Your cart is empty</h3>
                            <p style="margin-bottom: 20px;">Browse our collections and find something you love.</p>
                            <a href="{{ route('shop') }}" class="solid-btn" style="display:inline-block;text-align:center;text-decoration:none;width:auto;">Go to Shop</a>
                        </div>
                    @endif

                    @if(isset($items) && $items->count() > 0)
                        <div class="promo">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="ghost-btn" type="submit">Clear Cart</button>
                            </form>
                        </div>
                    @endif
                </div>

                <aside class="summary">
                    <h3>Order Summary</h3>
                    @if(isset($items) && $items->count() > 0)
                        <div class="summary-row"><span>Subtotal</span><span>₦{{ number_format($total ?? 0, 2) }}</span></div>
                        <div class="summary-row"><span>Estimated Taxes</span><span>₦0.00</span></div>
                        <div class="summary-row total"><span>Total</span><span>₦{{ number_format($total ?? 0, 2) }}</span></div>

                        <a href="{{ route('checkout') }}" class="solid-btn" style="display:inline-block;text-align:center;text-decoration:none;margin-top:20px;">Proceed to Checkout</a>
                    @else
                        <div class="summary-row"><span>Subtotal</span><span>₦0.00</span></div>
                        <div class="summary-row total"><span>Total</span><span>₦0.00</span></div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
