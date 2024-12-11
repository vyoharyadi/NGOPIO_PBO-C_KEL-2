<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}

    public function showCart()
    {

        $cartItems = session()->get('cart', []);
        return view('cart', compact('cartItems'));
    }

    public function confirmOrder(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::id();
        $order->total = $request->total;
        $order->status = 'pending';
        $order->save();

        foreach (session('cart') as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return redirect()->route('checkout', ['orderId' => $order->id]);
    }

    public function store(Request $request)
{
    $request->validate([
        'total' => 'required|numeric',
        'order_date' => 'required|date',
    ]);

    $total = $request->total;

    $order = Order::create([
        'user_id' => Auth::id(),
        'total' => $total,
        'order_date' => $request->order_date,
    ]);

    return response()->json([
        'message' => 'Order has been created successfully!',
        'order' => $order
    ]);
}

public function showCheckout()
{
    $user = auth()->user();

    if ($user) {
        $orders = Order::where('user_id', $user->id)->get();
    } else {
        $orders = collect();
    }

    dd($orders);

    return view('checkout', compact('orders'));
}

public function showOrders()
{

    $orders = Order::with('orderItems')->get();

    return view('cashier.order', compact('orders'));
}

public function markAsComplete($id)
{

    $order = Order::findOrFail($id);

    $order->status = 'completed';
    $order->save();

    return response()->json(['success' => true]);
}


}
