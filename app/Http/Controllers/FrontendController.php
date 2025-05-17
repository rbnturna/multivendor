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
        // Fetch categories
        $categories = \App\Models\Category::withCount('products')
        ->inRandomOrder()
        ->take(8) // Limit to 8 featured products

        ->get();
    
        // Fetch featured products
        $featuredProducts = \App\Models\Product::where('is_featured', true)
            ->with('categories')
            ->inRandomOrder()
            ->take(8) // Limit to 8 featured products
            ->get();
    
        // Fetch recent products
        $recentProducts = \App\Models\Product::orderBy('created_at', 'desc')
            ->with('categories')
            ->inRandomOrder()
            ->take(8) // Limit to 8 recent products
            ->get();
    
        return view('frontend.home', compact('categories', 'featuredProducts', 'recentProducts'));
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


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for products by name or tags
        $products = \App\Models\Product::where('name', 'LIKE', "%{$query}%")
            ->orWhereHas('tags', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->with('tags')
            ->take(10) // Limit results
            ->get();

        // Search for categories by name
        $categories = \App\Models\Category::where('name', 'LIKE', "%{$query}%")
            ->take(10) // Limit results
            ->get();

        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }


     /**
     * Display the Privacy Policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Display the Terms & Conditions page.
     *
     * @return \Illuminate\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }
}
