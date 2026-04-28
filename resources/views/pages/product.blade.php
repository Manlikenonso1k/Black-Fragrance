<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $product->name }} - Black Fragrance</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="{{ $product->subtitle ?? '' }}">
    <link rel="icon" type="image/png" href="/images/faav-icon.png">
    <base href="/">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Luxury Product Page Styles */
        :root {
            --black: #000000;
            --white: #FFFFFF;
            --light-grey: #F5F5F5;
            --border-grey: #E0E0E0;
            --dark-grey: #333333;
            --serif: 'Cormorant Garamond', serif;
            --sans: 'Inter', sans-serif;
        }

        body {
            font-family: var(--sans);
            background-color: var(--white);
            color: var(--dark-grey);
        }

        .breadcrumbs {
            padding: 20px 0;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-grey);
            text-transform: uppercase;
        }

        .breadcrumbs a {
            color: var(--dark-grey);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumbs a:hover {
            color: var(--black);
        }

        .product-hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            padding: 80px 0;
            align-items: start;
        }

        .product-gallery {
            position: relative;
        }

        .main-image {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            background-color: var(--light-grey);
            margin-bottom: 20px;
        }

        .thumbnail-strip {
            display: flex;
            gap: 12px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            border: 1px solid var(--border-grey);
            cursor: pointer;
            transition: border-color 0.2s ease;
            background-color: var(--light-grey);
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--black);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding-top: 20px;
        }

        .product-title {
            font-family: var(--serif);
            font-size: 48px;
            font-weight: 600;
            margin: 0 0 12px 0;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .product-subtitle {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
        }

        .price-section {
            padding: 30px 0;
            border-top: 1px solid var(--border-grey);
            border-bottom: 1px solid var(--border-grey);
            margin-bottom: 30px;
        }

        .price {
            font-family: var(--serif);
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stock-status {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--dark-grey);
        }

        .stock-status.in-stock {
            color: var(--black);
        }

        /* Color Swatches */
        .color-section {
            margin-bottom: 40px;
        }

        .color-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .color-swatches {
            display: flex;
            gap: 12px;
        }

        .color-swatch {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid var(--border-grey);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .color-swatch:hover,
        .color-swatch.active {
            border-color: var(--black);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Volume Selectors */
        .volume-section {
            margin-bottom: 40px;
        }

        .volume-options {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .volume-btn {
            padding: 10px 20px;
            border: 1px solid var(--border-grey);
            background-color: var(--white);
            color: var(--dark-grey);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 20px;
            font-weight: 500;
        }

        .volume-btn:hover,
        .volume-btn.active {
            background-color: var(--black);
            color: var(--white);
            border-color: var(--black);
        }

        /* Quantity and Add to Cart */
        .add-to-cart-section {
            display: flex;
            gap: 12px;
            margin-bottom: 40px;
            align-items: center;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-grey);
            width: 110px;
        }

        .quantity-input button {
            width: 36px;
            height: 36px;
            border: none;
            background-color: var(--white);
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .quantity-input button:hover {
            background-color: var(--light-grey);
        }

        .quantity-input input {
            flex: 1;
            border: none;
            text-align: center;
            font-size: 13px;
            background-color: transparent;
        }

        .add-to-cart-btn {
            flex: 1;
            padding: 12px 24px;
            background-color: var(--black);
            color: var(--white);
            border: none;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .add-to-cart-btn:hover {
            background-color: var(--dark-grey);
        }

        .wishlist-btn {
            width: 48px;
            height: 48px;
            border: 1px solid var(--border-grey);
            background-color: var(--white);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .wishlist-btn:hover {
            border-color: var(--black);
            background-color: var(--light-grey);
        }

        /* Product Features */
        .features-section {
            padding: 40px 0;
            border-top: 1px solid var(--border-grey);
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features-list li {
            padding: 8px 0;
            font-size: 13px;
            color: var(--dark-grey);
            position: relative;
            padding-left: 20px;
        }

        .features-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* Scent Notes */
        .scent-notes-section {
            padding: 40px 0;
            border-top: 1px solid var(--border-grey);
        }

        .scent-notes-title {
            font-family: var(--serif);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .scent-note-group {
            margin-bottom: 25px;
        }

        .scent-note-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .scent-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .scent-tag {
            background-color: var(--light-grey);
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 12px;
            color: var(--dark-grey);
            border: 1px solid var(--border-grey);
        }

        /* Accordion Sections */
        .accordion {
            border-top: 1px solid var(--border-grey);
        }

        .accordion-item {
            border-bottom: 1px solid var(--border-grey);
        }

        .accordion-header {
            padding: 20px 0;
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--white);
            border: none;
            width: 100%;
            text-align: left;
            transition: color 0.2s ease;
        }

        .accordion-header:hover {
            color: var(--black);
        }

        .accordion-header.active {
            color: var(--black);
        }

        .accordion-toggle {
            font-size: 14px;
            transition: transform 0.2s ease;
        }

        .accordion-header.active .accordion-toggle {
            transform: rotate(180deg);
        }

        .accordion-content {
            display: none;
            padding: 20px 0;
            font-size: 13px;
            line-height: 1.6;
            color: var(--dark-grey);
        }

        .accordion-content.active {
            display: block;
        }

        /* Related Products */
        .related-products-section {
            padding: 80px 0;
            border-top: 1px solid var(--border-grey);
        }

        .related-title {
            font-family: var(--serif);
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 40px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .product-card {
            position: relative;
        }

        .product-card-image {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            background-color: var(--light-grey);
            margin-bottom: 16px;
        }

        .product-card-name {
            font-family: var(--serif);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .product-card-price {
            font-size: 13px;
            color: var(--dark-grey);
            margin-bottom: 12px;
        }

        .quick-add-btn {
            display: none;
            position: absolute;
            bottom: 150px;
            left: 0;
            right: 0;
            margin: auto;
            padding: 10px 20px;
            background-color: var(--black);
            color: var(--white);
            border: none;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .product-card:hover .quick-add-btn {
            display: block;
        }

        .quick-add-btn:hover {
            background-color: var(--dark-grey);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-hero {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .product-title {
                font-size: 32px;
            }

            .price {
                font-size: 24px;
            }

            .add-to-cart-section {
                flex-direction: column;
            }

            .wishlist-btn {
                align-self: flex-start;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 480px) {
            .product-title {
                font-size: 24px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script src="js/modernizr.js"></script>
</head>
<body>

    <div class="preloader-wrapper">
        <div class="preloader"></div>
    </div>

    <div class="search-popup">
        <div class="search-popup-container">
            <form role="search" method="get" class="search-form" action="">
                <input type="search" id="search-form" class="search-field" placeholder="Type and press enter" value="" name="s" />
                <button type="submit" class="search-submit"><a href="#"><i class="icon icon-search"></i></a></button>
            </form>
            <h5 class="cat-list-title">Browse Categories</h5>
            <ul class="cat-list">
                <li class="cat-list-item"><a href="shop" title="Fragrances">Fragrances</a></li>
                <li class="cat-list-item"><a href="shop" title="Luxury Scents">Luxury Scents</a></li>
                <li class="cat-list-item"><a href="shop" title="Unisex">Unisex</a></li>
            </ul>
        </div>
    </div>

    <header id="header">
        <div id="header-wrap">
            <nav class="secondary-nav border-bottom">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4 header-contact">
                            <p>Luxury Fragrances | <strong>+1 (555) 123-4567</strong></p>
                        </div>
                        <div class="col-md-4 shipping-purchase text-center">
                            <p>Free shipping on orders over $150</p>
                        </div>
                        <div class="col-md-4 col-sm-12 user-items">
                            <ul class="d-flex justify-content-end list-unstyled">
                                <li><a href="login.html"><i class="icon icon-user"></i></a></li>
                                <li><a href="cart.html"><i class="icon icon-shopping-cart"></i></a></li>
                                <li><a href="wishlist.html"><i class="icon icon-heart"></i></a></li>
                                <li class="user-items search-item pe-3">
                                    <a href="#" class="search-button"><i class="icon icon-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="primary-nav padding-small">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-2 col-md-2">
                            <div class="main-logo">
                                <a href="index.html">
                                    <img src="images/main-logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="navbar">
                                <div id="main-nav" class="stellarnav d-flex justify-content-end right">
                                    <ul class="menu-list">
                                        <li class="menu-item has-sub">
                                            <a href="/" class="item-anchor d-flex align-item-center" data-effect="Home">Home<i class="icon icon-chevron-down"></i></a>
                                        </li>
                                        <li><a href="about.html" class="item-anchor" data-effect="About">About</a></li>
                                        <li class="menu-item has-sub">
                                            <a href="shop" class="item-anchor active d-flex align-item-center" data-effect="Shop">Shop<i class="icon icon-chevron-down"></i></a>
                                        </li>
                                        <li><a href="blog.html" class="item-anchor" data-effect="Blog">Blog</a></li>
                                        <li><a href="contact.html" class="item-anchor" data-effect="Contact">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="container" style="padding: 40px 0;">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <a href="/">Home</a> / <a href="/shop">Shop</a> / <span>{{ $product->name }}</span>
        </div>

        <!-- Product Hero Section -->
        <div class="product-hero">
            <!-- Gallery -->
            <div class="product-gallery">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="main-image" id="mainImage">
                @if ($product->images && count($product->images) > 1)
                    <div class="thumbnail-strip">
                        @foreach ($product->images as $image)
                            <div class="thumbnail active" onclick="changeImage('{{ $image }}', this)">
                                <img src="{{ $image }}" alt="thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-subtitle">{{ $product->subtitle }}</p>

                <!-- Price Section -->
                <div class="price-section">
                    <div class="price">${{ number_format($product->price, 2) }}</div>
                    <div class="stock-status {{ $product->in_stock ? 'in-stock' : '' }}">
                        {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                    </div>
                </div>

                <!-- Color Selection -->
                @if ($product->colors && count($product->colors) > 0)
                    <div class="color-section">
                        <label class="color-label">Choose Color Intensity</label>
                        <div class="color-swatches">
                            @foreach ($product->colors as $color)
                                <div class="color-swatch active" style="background-color: {{ $color }};" title="{{ $color }}"></div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Volume Selection -->
                <div class="volume-section">
                    <label class="color-label">Volume</label>
                    <div class="volume-options">
                        <button class="volume-btn active" onclick="selectVolume(this)">{{ $product->volume }}</button>
                        @if ($product->volume !== '50ml')
                            <button class="volume-btn" onclick="selectVolume(this)">50ml</button>
                        @endif
                    </div>
                </div>

                <!-- Add to Cart Section -->
                <div class="add-to-cart-section">
                    <div class="quantity-input">
                        <button onclick="decrementQty()">−</button>
                        <input type="number" id="quantity" value="1" min="1">
                        <button onclick="incrementQty()">+</button>
                    </div>
                    <button class="add-to-cart-btn" onclick="addToCart({{ $product->id }})">Add to Cart</button>
                    <button class="wishlist-btn" onclick="addToWishlist({{ $product->id }})" title="Add to Wishlist">
                        <i class="icon icon-heart"></i>
                    </button>
                </div>

                <!-- Features -->
                @if ($product->description)
                    <div class="features-section">
                        <p style="font-size: 13px; line-height: 1.8; color: var(--dark-grey);">
                            {{ $product->description }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Scent Notes -->
        @if ($product->top_notes || $product->heart_notes || $product->base_notes)
            <div class="scent-notes-section">
                <h2 class="scent-notes-title">Scent Profile</h2>
                @if ($product->top_notes)
                    <div class="scent-note-group">
                        <span class="scent-note-label">Top Notes</span>
                        <div class="scent-tags">
                            @foreach (explode(',', $product->top_notes) as $note)
                                <span class="scent-tag">{{ trim($note) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($product->heart_notes)
                    <div class="scent-note-group">
                        <span class="scent-note-label">Heart Notes</span>
                        <div class="scent-tags">
                            @foreach (explode(',', $product->heart_notes) as $note)
                                <span class="scent-tag">{{ trim($note) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($product->base_notes)
                    <div class="scent-note-group">
                        <span class="scent-note-label">Base Notes</span>
                        <div class="scent-tags">
                            @foreach (explode(',', $product->base_notes) as $note)
                                <span class="scent-tag">{{ trim($note) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Accordion Sections -->
        <div class="accordion">
            @if ($product->ingredients)
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Ingredients & Formula</span>
                        <span class="accordion-toggle">▼</span>
                    </button>
                    <div class="accordion-content">
                        {{ $product->ingredients }}
                    </div>
                </div>
            @endif
            @if ($product->care_instructions)
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Care & Storage</span>
                        <span class="accordion-toggle">▼</span>
                    </button>
                    <div class="accordion-content">
                        {{ $product->care_instructions }}
                    </div>
                </div>
            @endif
        </div>

        <!-- You May Also Like Section -->
        <div class="related-products-section">
            <h2 class="related-title">You May Also Like</h2>
            <div class="products-grid">
                {{-- This would typically pull related products, for now showing all others --}}
                @php
                    $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)->take(4)->get();
                @endphp
                @forelse ($relatedProducts as $related)
                    <div class="product-card">
                        <a href="/product/{{ $related->slug }}">
                            <img src="{{ $related->image }}" alt="{{ $related->name }}" class="product-card-image">
                            <button class="quick-add-btn" onclick="event.stopPropagation(); quickAdd({{ $related->id }})">Quick Add</button>
                        </a>
                        <h3 class="product-card-name">{{ $related->name }}</h3>
                        <p class="product-card-price">${{ number_format($related->price, 2) }}</p>
                    </div>
                @empty
                    <p>No other products available.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer" style="margin-top: 80px; padding-top: 80px; border-top: 1px solid var(--border-grey);">
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-between" style="margin-bottom: 40px;">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h4 style="font-family: var(--serif); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Our Mission</h4>
                    <p style="font-size: 12px; line-height: 1.6; color: var(--dark-grey);">Crafting luxurious fragrances that elevate the everyday experience with elegance and sophistication.</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h4 style="font-family: var(--serif); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Shop</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li><a href="/shop" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">All Fragrances</a></li>
                        <li><a href="/shop" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">Collections</a></li>
                        <li><a href="/shop" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">New Arrivals</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h4 style="font-family: var(--serif); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Support</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li><a href="/contact" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">Contact Us</a></li>
                        <li><a href="#" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">Shipping Info</a></li>
                        <li><a href="#" style="font-size: 12px; color: var(--dark-grey); text-decoration: none;">Returns</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h4 style="font-family: var(--serif); font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Newsletter</h4>
                    <form style="display: flex;">
                        <input type="email" placeholder="Your email" style="flex: 1; padding: 8px; border: 1px solid var(--border-grey); font-size: 12px;">
                        <button type="submit" style="padding: 8px 16px; background-color: var(--black); color: var(--white); border: none; cursor: pointer; font-size: 12px; font-weight: 600;">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <hr style="margin: 0; border: none; border-top: 1px solid var(--border-grey);">
        <div style="padding: 20px 0; text-align: center; font-size: 12px; color: var(--dark-grey);">
            <p>&copy; 2026 Black Fragrance. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function changeImage(src, element) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            element.classList.add('active');
        }

        function selectVolume(btn) {
            document.querySelectorAll('.volume-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function incrementQty() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function toggleAccordion(header) {
            header.classList.toggle('active');
            header.nextElementSibling.classList.toggle('active');
        }

        function addToCart(productId) {
            const qty = document.getElementById('quantity').value;
            console.log('Added to cart:', productId, 'Qty:', qty);
            alert('Product added to cart! (Coming soon)');
        }

        function addToWishlist(productId) {
            console.log('Added to wishlist:', productId);
            alert('Added to wishlist! (Coming soon)');
        }

        function quickAdd(productId) {
            console.log('Quick add:', productId);
            alert('Product added to cart! (Coming soon)');
        }
    </script>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
</html>