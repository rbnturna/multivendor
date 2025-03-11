<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Attribute;

class FrontendController extends Controller
{
    public function home(): View
    {
        return view('frontend/home');
    }

    public function product(): View
    {
        $products = Product::all();
        $attributes = Attribute::with('values')->get();
        return view('frontend.shop', compact('products', 'attributes'));
    }
    // public function detail(): View
    // {
    //     return view('frontend/detail');
    // }

    public function detail($slug): View
    {
        // Fetch the product by slug
        // $relatedProduct = Product::where('slug', $slug)->firstOrFail();
        // // Fetch related products from the same category or tags
        $product = Product::where('slug', $slug)->with(['categories', 'variations', 'tags'])->firstOrFail();
        $relatedProducts = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->orWhereHas('tags', function ($query) use ($product) {
            $query->whereIn('tags.id', $product->tags->pluck('id'));
        })
        ->where('products.id', '!=', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get();
        $attributes = Attribute::with('values')->get();
        
        return view('frontend.detail', compact('product','relatedProducts','attributes'));
    }
    public function contact(): View
    {
        return view('frontend/contact');
    }
    public function checkout(): View
    {
        return view('frontend/checkout');
    }
    public function cart(): View
    {
        return view('frontend/cart');
    }
}
