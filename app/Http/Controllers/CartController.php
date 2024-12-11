<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        $total = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->quantity);

        return view('user.cart', compact('cartItems', 'total'));
    }

public function showCashierMenu()
{
    $products = Product::all();
    $cartItems = Cart::with('product')->get();
    $total = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->quantity);

    return view('cashier.menu', compact('products', 'cartItems', 'total'));
}

public function addToCartFromCashier(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $cart = Cart::where('product_id', $product->id)->first();
    if ($cart) {
        $cart->increment('quantity');
    } else {
        Cart::create([
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    return redirect()->route('cashier.menu')->with('success', 'Product added to cart!');
}

public function updateCartFromCashier(Request $request, $id)
{
    $cart = Cart::findOrFail($id);
    $cart->update(['quantity' => $request->quantity]);

    return redirect()->route('cashier.menu')->with('success', 'Cart updated successfully!');
}

public function removeFromCartFromCashier($id)
{
    $cart = Cart::findOrFail($id);
    $cart->delete();

    return redirect()->route('cashier.menu')->with('success', 'Item removed from cart!');
}

public function checkoutFromCashier()
{
    $cartItems = Cart::with('product')->get();
    $total = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->quantity);

    $order = Order::create([
        'user_id' => auth()->id(),
        'total' => $total,
        'status' => 'pending',
    ]);

    Cart::truncate();

    return redirect()->route('cashier.menu')->with('success', 'Order completed successfully!');
}

public function search(Request $request)
{
    $search = $request->query('search');
    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'LIKE', "%$search%");
    })->get();

    $cartItems = Cart::with('product')->get();
    $total = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->quantity);

    return view('cashier.menu', compact('products', 'cartItems', 'total', 'search'));
}

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('product_id', $product->id)->first();
        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index');
    }

    public function removeFromCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index');
    }

public function checkout(Request $request)
{

    $cartItems = Cart::with('product')->get();

    $total = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->quantity);

    $order = Order::create([
        'user_id' => auth()->id(),
        'total' => $total,
        'status' => 'pending',
    ]);

    foreach ($cartItems as $cart) {
        $order->orderItems()->create([
            'product_id' => $cart->product->id,
            'product_name' => $cart->product->name,
            'quantity' => $cart->quantity,
            'price' => $cart->product->price,
        ]);
    }

    Cart::truncate();

    return redirect()->route('user.menu')->with('success', 'Order placed successfully!');
}

}
