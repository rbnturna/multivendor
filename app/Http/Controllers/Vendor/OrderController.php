<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function canceledOrders()
    {
        $orders = Order::where('status', 'cancelled')
            ->with('items.variation.product')
            ->get();

        return view('vendor.orders.canceled', compact('orders'));
    }

    public function completedOrders()
    {
        $orders = Order::where('status', 'completed')
            ->with('items.variation.product')
            ->get();

        return view('vendor.orders.completed', compact('orders'));
    }
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.variation.product')->get();
        return view('vendor.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::with('variations')->get(); // Fetch products with variations
        return view('vendor.orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.variation_id' => 'nullable|exists:variations,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;
        foreach ($data['items'] as $item) {
            if (!empty($item['variation_id'])) {
                $variation = Variation::findOrFail($item['variation_id']);
                $totalPrice += $variation->price * $item['quantity'];
            } else {
                $product = Product::findOrFail($item['product_id']);
                $totalPrice += $product->price * $item['quantity'];
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'shipping_address' => $data['shipping_address'],
            'payment_method' => $data['payment_method'],
        ]);

        foreach ($data['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variation_id' => $item['variation_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => !empty($item['variation_id'])
                    ? Variation::findOrFail($item['variation_id'])->price
                    : Product::findOrFail($item['product_id'])->price,
            ]);
        }

        return redirect()->route('vendor.orders.index')->with('success', 'Order created successfully!');
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.variation.product')->firstOrFail();
        return view('vendor.orders.edit', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.variation.product')->firstOrFail();
        $products = Product::with('variations')->get();
        return view('vendor.orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.variation_id' => 'nullable|exists:variations,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->update([
            'shipping_address' => $data['shipping_address'],
            'payment_method' => $data['payment_method'],
            'status' => $data['status'],
        ]);

        $order->items()->delete(); // Remove old items
        $totalPrice = 0;

        foreach ($data['items'] as $item) {
            if (!empty($item['variation_id'])) {
                $variation = Variation::findOrFail($item['variation_id']);
                $totalPrice += $variation->price * $item['quantity'];
            } else {
                $product = Product::findOrFail($item['product_id']);
                $totalPrice += $product->price * $item['quantity'];
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variation_id' => $item['variation_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => !empty($item['variation_id'])
                    ? Variation::findOrFail($item['variation_id'])->price
                    : Product::findOrFail($item['product_id'])->price,
            ]);
        }

        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('vendor.orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->delete();
        return redirect()->route('vendor.orders.index')->with('success', 'Order deleted successfully!');
    }
}
