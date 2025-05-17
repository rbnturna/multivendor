<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{


    public function index()
    {
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('user_id', auth()->id())->with('product')->get();
        } else {
            $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
            $wishlistItems = Product::whereIn('id', $wishlist)->get();
        }
        return view('frontend.wishlist', compact('wishlistItems'));
    }


    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if (Auth::check()) {
            $wishlistItem = Wishlist::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                ]
            );
            $totalItems = Wishlist::where('user_id', Auth::id())->count();
            return response()->json([
                'message' => 'Product added to wishlist',
                'wishlist' => $wishlistItem,
                'total_items' => $totalItems,
            ]);
        } else {
            $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
            $wishlist[] = $request->product_id;
            $wishlist = array_unique($wishlist);
            $totalItems = count($wishlist);
            return response()->json([
                'message' => 'Product added to wishlist',
                'wishlist' => $wishlist,
                'total_items' => $totalItems,
            ], 200)->cookie('wishlist', json_encode($wishlist), 60 * 24 * 30); // Store for 30 days
        }
    }

    public function removeFromWishlist($id)
    {
        if (Auth::check()) {
            $wishlistItem = Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $wishlistItem->delete();
            return response()->json(['message' => 'Product removed from wishlist']);
        } else {
            $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
            $wishlist = array_diff($wishlist, [$id]);
            return response()->json(['message' => 'Product removed from wishlist'], 200)
                ->cookie('wishlist', json_encode($wishlist), 60 * 24 * 30);
        }
    }

    public function viewWishlist()
    {
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
            return response()->json($wishlistItems);
        } else {
            $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
            $products = Product::whereIn('id', $wishlist)->get();
            return response()->json($products);
        }
    }

    public function moveToCart($id)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $product = Product::findOrFail($wishlistItem->product_id);

        if ($product->stock > 0) {
            // Logic to add the product to the cart
            // Assuming you have a CartController with an addToCart method
            app(CartController::class)->addToCart(new Request([
                'product_id' => $product->id,
                'quantity' => 1, // Default quantity
            ]));

            return response()->json(['message' => 'Product moved to cart']);
        } else {
            return response()->json(['message' => 'Product is out of stock'], 400);
        }
    }
}