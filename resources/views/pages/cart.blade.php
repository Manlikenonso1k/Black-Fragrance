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
        }

        .qty span {
            width: 32px;
            text-align: center;
            font-size: 12px;
            border-left: 1px solid var(--mono-gray-200);
            border-right: 1px solid var(--mono-gray-200);
        }

        .text-link {
            border: 0;
            background: transparent;
            color: var(--mono-gray-500);
            padding: 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
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
            <div class="cart-grid">
                <div class="cart-list">
                    <article class="cart-item">
                        <img class="cart-thumb" src="images/selling-products4.jpg" alt="Grunge Hoodie">
                        <div>
                            <h3>Grunge Hoodie</h3>
                            <p class="variant">Variant: M / Onyx</p>
                            <div class="cart-meta">
                                <span class="price">$30.00</span>
                                <span class="qty"><button type="button">-</button><span>1</span><button type="button">+</button></span>
                                <button class="text-link" type="button">Remove</button>
                                <label class="save"><input type="checkbox"> Save for later</label>
                            </div>
                        </div>
                    </article>

                    <article class="cart-item">
                        <img class="cart-thumb" src="images/selling-products5.jpg" alt="Full Sleeve Jeans Jacket">
                        <div>
                            <h3>Full Sleeve Jeans Jacket</h3>
                            <p class="variant">Variant: L / Graphite</p>
                            <div class="cart-meta">
                                <span class="price">$40.00</span>
                                <span class="qty"><button type="button">-</button><span>1</span><button type="button">+</button></span>
                                <button class="text-link" type="button">Remove</button>
                                <label class="save"><input type="checkbox"> Save for later</label>
                            </div>
                        </div>
                    </article>

                    <article class="cart-item">
                        <img class="cart-thumb" src="images/selling-products6.jpg" alt="Grey Check Coat">
                        <div>
                            <h3>Grey Check Coat</h3>
                            <p class="variant">Variant: XL / Midnight</p>
                            <div class="cart-meta">
                                <span class="price">$30.00</span>
                                <span class="qty"><button type="button">-</button><span>2</span><button type="button">+</button></span>
                                <button class="text-link" type="button">Remove</button>
                                <label class="save"><input type="checkbox"> Save for later</label>
                            </div>
                        </div>
                    </article>

                    <div class="promo">
                        <input type="text" placeholder="Enter promo code">
                        <button class="ghost-btn" type="button">Apply</button>
                    </div>
                </div>

                <aside class="summary">
                    <h3>Order Summary</h3>
                    <div class="summary-row"><span>Subtotal</span><span>$100.00</span></div>
                    <div class="summary-row"><span>Discounts</span><span>-$10.00</span></div>
                    <div class="summary-row"><span>Estimated Taxes</span><span>$7.00</span></div>
                    <div class="summary-row total"><span>Total</span><span>$97.00</span></div>

                    <div class="shipping">
                        <label for="zip">ZIP</label>
                        <input id="zip" type="text" placeholder="100001">
                        <label for="country" style="margin-top: 10px;">Country</label>
                        <select id="country">
                            <option>Nigeria</option>
                            <option>Ghana</option>
                            <option>United Kingdom</option>
                            <option>United States</option>
                        </select>
                    </div>

                    <a href="/checkout" class="solid-btn" style="display:inline-block;text-align:center;text-decoration:none;">Proceed to Checkout</a>
                </aside>
            </div>

            <section class="upsell">
                <h2>You Might Also Like</h2>
                <div class="upsell-grid">
                    <div class="upsell-card">
                        <img src="images/selling-products7.jpg" alt="Long Sleeve T-shirt">
                        <h4>Long Sleeve T-shirt</h4>
                        <p>$40.00</p>
                        <button class="ghost-btn" type="button">Quick Add</button>
                    </div>
                    <div class="upsell-card">
                        <img src="images/selling-products13.jpg" alt="Orange White Nike">
                        <h4>Orange White Nike</h4>
                        <p>$55.00</p>
                        <button class="ghost-btn" type="button">Quick Add</button>
                    </div>
                    <div class="upsell-card">
                        <img src="images/selling-products14.jpg" alt="Running Shoe">
                        <h4>Running Shoe</h4>
                        <p>$65.00</p>
                        <button class="ghost-btn" type="button">Quick Add</button>
                    </div>
                    <div class="upsell-card">
                        <img src="images/selling-products15.jpg" alt="Tennis Shoe">
                        <h4>Tennis Shoe</h4>
                        <p>$80.00</p>
                        <button class="ghost-btn" type="button">Quick Add</button>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
