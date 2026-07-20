<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Livewire\Attributes\Computed;

class PointOfSale extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static string $view = 'filament.pages.point-of-sale';

    protected static ?string $navigationGroup = 'Sales';
    
    protected static ?string $navigationLabel = 'Point of Sale (POS)';
    
    protected static ?string $title = 'Point of Sale';

    public $selectedCategory = null;
    public $viewMode = 'categories';
    public $search = '';
    public $cart = [];

    #[Computed]
    public function categories()
    {
        return Category::withCount('products')->get();
    }

    #[Computed]
    public function products()
    {
        $query = Product::query()->where('in_stock', true);
        
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return $query->get();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->viewMode = 'products';
    }

    public function backToCategories()
    {
        $this->selectedCategory = null;
        $this->viewMode = 'categories';
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        if (isset($this->cart[$productId])) {
            // Check stock limit
            if ($this->cart[$productId]['quantity'] < $product->stock) {
                $this->cart[$productId]['quantity']++;
            } else {
                Notification::make()->warning()->title('Not enough stock')->send();
            }
        } else {
            if ($product->stock > 0) {
                $this->cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image,
                ];
            } else {
                 Notification::make()->warning()->title('Out of stock')->send();
            }
        }
    }

    public function incrementQuantity($productId)
    {
        $product = Product::find($productId);
        if ($this->cart[$productId]['quantity'] < $product->stock) {
            $this->cart[$productId]['quantity']++;
        } else {
            Notification::make()->warning()->title('Not enough stock')->send();
        }
    }

    public function decrementQuantity($productId)
    {
        if ($this->cart[$productId]['quantity'] > 1) {
            $this->cart[$productId]['quantity']--;
        } else {
            unset($this->cart[$productId]);
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    #[Computed]
    public function cartTotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function checkout()
    {
        if (empty($this->cart)) return;

        $total = $this->cartTotal;
        $order = Order::create([
            'user_id' => Auth::id() ?? 1, // Fallback if no user
            'order_number' => 'POS-' . strtoupper(uniqid()),
            'subtotal' => $total,
            'tax' => 0,
            'shipping' => 0,
            'total' => $total,
            'status' => 'completed',
            'payment_status' => 'success',
            'payment_gateway' => 'pos',
            'first_name' => 'In-Store',
            'last_name' => 'Customer',
            'email' => 'pos@store.com',
            'phone' => '',
            'address' => 'In-Store',
            'city' => '',
            'state' => '',
            'postal_code' => '',
            'country' => 'NG',
        ]);

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);

            // Deduct stock
            $product = Product::find($item['id']);
            if ($product) {
                $newStock = max(0, $product->stock - $item['quantity']);
                $product->update([
                    'stock' => $newStock,
                    'in_stock' => $newStock > 0,
                ]);
            }
        }

        $this->cart = [];
        
        Notification::make()
            ->title('Sale completed successfully')
            ->success()
            ->send();
    }
}
