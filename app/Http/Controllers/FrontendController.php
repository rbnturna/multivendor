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
        $relatedProduct = Product::where('slug', $slug)->firstOrFail();
        $attributes = Attribute::with('values')->get();
        return view('frontend.detail', compact('relatedProduct','attributes'));
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
