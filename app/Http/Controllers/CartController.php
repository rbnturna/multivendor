<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Variation;
use App\Models\ShippingCost;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Charge;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_id' => 'nullable|exists:variations,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'variation_id' => $request->variation_id,
            ],
            ['quantity' => \DB::raw('quantity + ' . $request->quantity)]
        );

        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }

    // public function viewCart()
    // {
    //     $cartItems = Cart::where('user_id', auth()->id())->with(['product', 'variation'])->get();

    //     return response()->json($cartItems);
    // }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated', 'cart' => $cartItem]);
    }

    public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|exists:coupons,code',
    ]);

    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if (!$coupon) {
        return back()->withErrors(['coupon_code' => 'Invalid coupon code.']);
    }

    session(['coupon' => $coupon]);

    return back()->with('success', 'Coupon applied successfully.');
}

public function viewCart(Request $request)
{
    $cartItems = Cart::where('user_id', auth()->id())->with(['product', 'variation'])->get();
    $subtotal = $cartItems->sum(function ($item) {
        return ($item->variation ? $item->variation->price : $item->product->price) * $item->quantity;
    });

     // Example: Fetch shipping cost based on user's region
     $userRegion = auth()->user()->region??null; // Assuming you have a region field in the users table
     $shippingCost = ShippingCost::where('region', $userRegion)->first()->cost ?? 100;
 
    // $shippingCost = 10; // Example shipping cost
    $coupon = session('coupon');
    $discount = $coupon ? $coupon->discount($subtotal) : 0;
    $total = $subtotal + $shippingCost - $discount;

    if ($request->ajax()) {
        return response()->json(compact('cartItems', 'subtotal', 'shippingCost', 'discount', 'total'));
    }else{
        return view('frontend.cart', compact('cartItems', 'subtotal', 'shippingCost', 'discount', 'total'));
    }
}
public function showCheckout()
{
    $cartItems = Cart::where('user_id', auth()->id())->with(['product', 'variation'])->get();
    $subtotal = $cartItems->sum(function ($item) {
        return ($item->variation ? $item->variation->price : $item->product->price) * $item->quantity;
    });

    $userRegion = auth()->user()->region ?? null;
    $shippingCost = ShippingCost::where('region', $userRegion)->first()->cost ?? 100;
    $coupon = session('coupon');
    $discount = $coupon ? $coupon->discount($subtotal) : 0;
    $total = $subtotal + $shippingCost - $discount;

    return view('frontend.checkout', compact('cartItems', 'subtotal', 'shippingCost', 'discount', 'total'));
}

    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'payment_method' => 'required|string|in:paypal,directcheck,banktransfer,stripe',
            'password' => 'nullable|required_if:create_account,on|string|min:8|confirmed',
            'shipping_first_name' => 'nullable|string|max:255',
            'shipping_last_name' => 'nullable|string|max:255',
            'shipping_email' => 'nullable|email|max:255',
            'shipping_phone' => 'nullable|string|max:15',
            'shipping_address1' => 'nullable|string|max:255',
            'shipping_address2' => 'nullable|string|max:255',
            'shipping_country' => 'nullable|string|max:255',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_zip' => 'nullable|string|max:10',
            'stripeToken' => 'required_if:payment_method,stripe',
        ]);

        if ($request->create_account) {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            auth()->login($user);
        }

        $cartItems = Cart::where('user_id', auth()->id())->with(['product', 'variation'])->get();
        $subtotal = $cartItems->sum(function ($item) {
            return ($item->variation ? $item->variation->price : $item->product->price) * $item->quantity;
        });

        $userRegion = auth()->user()->region ?? null;
        $shippingCost = ShippingCost::where('region', $userRegion)->first()->cost ?? 100;
        $coupon = session('coupon');
        $discount = $coupon ? $coupon->discount($subtotal) : 0;
        $total = $subtotal + $shippingCost - $discount;

        if ($request->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $charge = Charge::create([
                    'amount' => $total * 100, // Amount in cents
                    'currency' => 'usd',
                    'description' => 'Order Payment',
                    'source' => $request->stripeToken,
                    'metadata' => [
                        'order_id' => uniqid(),
                    ],
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'shipping_first_name' => $request->ship_to_different_address ? $request->shipping_first_name : $request->first_name,
            'shipping_last_name' => $request->ship_to_different_address ? $request->shipping_last_name : $request->last_name,
            'shipping_email' => $request->ship_to_different_address ? $request->shipping_email : $request->email,
            'shipping_phone' => $request->ship_to_different_address ? $request->shipping_phone : $request->phone,
            'shipping_address1' => $request->ship_to_different_address ? $request->shipping_address1 : $request->address1,
            'shipping_address2' => $request->ship_to_different_address ? $request->shipping_address2 : $request->address2,
            'shipping_country' => $request->ship_to_different_address ? $request->shipping_country : $request->country,
            'shipping_city' => $request->ship_to_different_address ? $request->shipping_city : $request->city,
            'shipping_state' => $request->ship_to_different_address ? $request->shipping_state : $request->state,
            'shipping_zip' => $request->ship_to_different_address ? $request->shipping_zip : $request->zip,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'variation_id' => $item->variation_id,
                'quantity' => $item->quantity,
                'price' => $item->variation ? $item->variation->price : $item->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();
        session()->forget('coupon');
        $encryptedOrderId = Crypt::encryptString($order->id);

        return redirect()->route('order.success', ['order' => $order->id])->with('success', 'Order placed successfully.');
    }

    public function showOrderSuccess($encryptedOrderId)
    {
        try {
            $orderId = Crypt::decryptString($encryptedOrderId);
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Invalid order ID.']);
        }
    
        $order = Order::with('items.product', 'items.variation')->findOrFail($orderId);
    
        return view('frontend.order-success', compact('order'));
    }
}