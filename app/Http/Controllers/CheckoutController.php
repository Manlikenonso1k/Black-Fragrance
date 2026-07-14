<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessCheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(): View|RedirectResponse
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $items = $cart->items()->with(['product', 'variant'])->get();
        $total = $cart->getTotal();

        return view('pages.checkout', compact('cart', 'items', 'total'));
    }

    // Processing now redirects to TGI Pay, handled by PaymentController in next step
    public function process(ProcessCheckoutRequest $request): RedirectResponse
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $subtotal = $cart->getTotal();
        $tax = 0; // Configurable later
        $shipping = 0; // Configurable later
        $total = $subtotal + $tax + $shipping;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'notes' => $request->notes ?? '',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'variant_id' => $item->variant_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity,
            ]);
        }

        // We don't delete cart items yet in case payment fails
        // session()->put('last_order_id', $order->id);

        // Redirect to TGI Pay gateway
        return redirect()->route('payment.tgipay.initiate', ['order' => $order->id]);
    }

    public function success(Order $order): View
    {
        $isOwner = Auth::check() && $order->user_id === Auth::id();
        $isGuestOrder = ! Auth::check() && $order->user_id === null;

        // Simplified authorization for now. In a real app, use signed URLs or session tracking for guest orders.
        abort_unless($isOwner || $isGuestOrder, 403);

        return view('pages.order-success', compact('order'));
    }
}
