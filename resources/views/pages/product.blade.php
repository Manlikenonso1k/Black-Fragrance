@extends('layouts.app')

@section('content')

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
@endsection
