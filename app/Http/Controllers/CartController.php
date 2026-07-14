<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    protected function getCart(): Cart
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        }
        
        return $cart;
    }

    public function index(): View
    {
        $cart = $this->getCart();
        $items = $cart->items()->with(['product', 'variant'])->get();
        $total = $cart->getTotal();

        return view('pages.cart', compact('cart', 'items', 'total'));
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($request->product_id);
        $price = $product->price;
        $variantId = null;

        if ($product->is_variable) {
            $variant = null;

            if ($request->filled('variant_id')) {
                $variant = $product->variants()->find($request->variant_id);
            }

            if (! $variant) {
                // BF variant structure is different, fallback to first if none provided
                $variant = $product->variants()->orderBy('id')->first();
            }

            if ($variant) {
                $price = $variant->price;
                $variantId = $variant->id;
            }
        }

        $existingItemQuery = $cart->items()->where('product_id', $product->id);

        if ($variantId !== null) {
            $existingItemQuery->where('variant_id', $variantId);
        } else {
            $existingItemQuery->whereNull('variant_id');
        }

        $existingItem = $existingItemQuery->first();

        if ($existingItem instanceof CartItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'quantity' => $request->quantity,
                'price' => $price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->cart_id === $this->getCart()->id, 403);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->cart_id === $this->getCart()->id, 403);

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clear(): RedirectResponse
    {
        $cart = $this->getCart();
        $cart->items()->delete();

        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
