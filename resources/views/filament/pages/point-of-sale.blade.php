<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Left/Main Side: Categories and Products -->
        <div class="md:col-span-2 space-y-6">
            
            <!-- Search (Floating) -->
            <div class="sticky top-24 z-10 backdrop-blur-md bg-white/70 dark:bg-gray-900/70 shadow-sm rounded-xl p-2 border dark:border-gray-800">
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search products..."
                    />
                </x-filament::input.wrapper>
            </div>

            <!-- Categories -->
            @if($viewMode === 'categories')
                <div>
                    <h3 class="text-lg font-medium mb-3">Categories</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($this->categories as $category)
                            <div 
                                wire:click="selectCategory({{ $category->id }})"
                                class="cursor-pointer border rounded-lg p-3 flex flex-col items-center justify-center gap-2 transition-colors bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                            >
                                @if($category->image)
                                    <img src="{{ Storage::disk('public_uploads')->url($category->image) }}" class="w-12 h-12 rounded object-cover" />
                                @else
                                    <div class="w-12 h-12 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                        <x-heroicon-o-photo class="w-6 h-6" />
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-center">{{ $category->name }}</span>
                                <span class="text-xs text-gray-500">{{ $category->products_count }} items</span>
                            </div>
                        @endforeach
                    </div>
                    @if($this->categories->whereNull('image')->count() > 0)
                        <p class="text-xs text-gray-500 mt-2">Tip: You can add images to categories in the <a href="{{ route('filament.admin.resources.categories.index') }}" class="text-primary-600 underline">Categories page</a>.</p>
                    @endif
                </div>
            @endif

            <!-- Products -->
            @if($viewMode === 'products')
                <div>
                    <div class="flex items-center justify-between mb-4 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <button wire:click="backToCategories" class="flex items-center gap-1 text-sm font-medium px-3 py-1.5 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <x-heroicon-o-arrow-left class="w-4 h-4" />
                                Back to Categories
                            </button>
                            <h3 class="text-lg font-medium">Products</h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @forelse($this->products as $product)
                            <div 
                                wire:click="addToCart({{ $product->id }})"
                                class="cursor-pointer bg-white dark:bg-gray-800 border rounded-lg overflow-hidden hover:ring-2 hover:ring-primary-500 transition-all flex flex-col"
                            >
                                <div class="h-32 bg-gray-100 dark:bg-gray-700 flex items-center justify-center relative">
                                    @if($product->image)
                                        <img src="{{ Storage::disk('public_uploads')->url($product->image) }}" class="w-full h-full object-cover" />
                                    @else
                                        <x-heroicon-o-cube class="w-8 h-8 text-gray-400" />
                                    @endif
                                    <div class="absolute top-2 right-2 bg-white dark:bg-gray-800 rounded px-2 py-1 text-xs font-bold shadow">
                                        ₦{{ number_format($product->price) }}
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4 class="font-medium text-sm line-clamp-2">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-gray-500">
                                No products found.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Side: Cart / Current Sale -->
        <div class="md:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border p-4 sticky top-6">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <x-heroicon-o-shopping-cart class="w-6 h-6" />
                    Current Sale
                </h2>

                <div class="space-y-4 max-h-[50vh] overflow-y-auto mb-4 pr-2">
                    @forelse($cart as $id => $item)
                        <div class="flex items-start justify-between border-b dark:border-gray-700 pb-3">
                            <div class="flex-1">
                                <h4 class="font-medium text-sm">{{ $item['name'] }}</h4>
                                <div class="text-xs text-gray-500 mt-1">₦{{ number_format($item['price']) }} each</div>
                                
                                <div class="flex items-center gap-3 mt-2">
                                    <button wire:click="decrementQuantity({{ $id }})" class="w-6 h-6 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-gray-200">-</button>
                                    <span class="text-sm font-medium">{{ $item['quantity'] }}</span>
                                    <button wire:click="incrementQuantity({{ $id }})" class="w-6 h-6 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-gray-200">+</button>
                                </div>
                            </div>
                            <div class="text-right flex flex-col items-end gap-2">
                                <span class="font-medium">₦{{ number_format($item['price'] * $item['quantity']) }}</span>
                                <button wire:click="removeFromCart({{ $id }})" class="text-red-500 hover:text-red-700">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <x-heroicon-o-shopping-bag class="w-12 h-12 mx-auto mb-2 opacity-20" />
                            <p>Cart is empty</p>
                            <p class="text-xs mt-1">Click products to add them</p>
                        </div>
                    @endforelse
                </div>

                @if(!empty($cart))
                    <div class="pt-4 border-t dark:border-gray-700">
                        <div class="flex items-center justify-between text-lg font-bold mb-6">
                            <span>Total</span>
                            <span>₦{{ number_format($this->cartTotal) }}</span>
                        </div>
                        
                        <x-filament::button size="lg" class="w-full" wire:click="checkout" wire:loading.attr="disabled">
                            Complete Sale (₦{{ number_format($this->cartTotal) }})
                        </x-filament::button>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-filament-panels::page>
