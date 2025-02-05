<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
     /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        $categories = Category::all();
        return view('superadmin.product.index', compact('products','categories'));
        // return response()->json($products);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('superadmin.product.create',compact('tags','categories'));
        // Return a view for creating products (if using Blade).
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'selling_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'stock' => 'nullable|integer',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle main image upload
        $imagePath = $request->file('image')->store('products/images', 'public');

        // Handle gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImages[] = $galleryImage->store('products/gallery', 'public');
            }
        }

        // Save product details
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
            'gallery_images' => $galleryImages,
            'price' => $request->price,
            'selling_price' => $request->selling_price,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);
        return redirect()->route('superadmin.products.index')->with('success', 'Product created successfully!');
        // return response()->json(['message' => 'Product created successfully', 'product' => $product]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        // dd($id);
        $product = Product::with('variations')->find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('superadmin.product.edit',compact('product','categories','tags'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'selling_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'stock' => 'nullable|integer',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle main image upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image); // Delete old image
            $product->image = $request->file('image')->store('products/images', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $oldGalleryImages = json_decode($product->gallery_images, true) ?? [];
            foreach ($oldGalleryImages as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            $galleryImages = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImages[] = $galleryImage->store('products/gallery', 'public');
            }
            $product->gallery_images = $galleryImages;
        }

        // Update product details
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'selling_price' => $request->selling_price,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);
        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);
        return redirect()->route('superadmin.products.edit',$id )->with('success', 'Product updated successfully!');
        //return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach(); 
        // Delete images
        Storage::disk('public')->delete($product->image);
        foreach (json_decode($product->gallery_images, true) as $galleryImage) {
            Storage::disk('public')->delete($galleryImage);
        }

        $product->delete();
        return redirect()->route('superadmin.products.index')->with('success', 'Product deleted successfully!');
        //return response()->json(['message' => 'Product deleted successfully']);
    }

    public function getVariations($id)
    {
        $product = Product::with('variations')->findOrFail($id);

        // Return the variations with attributes as JSON
        return response()->json($product->variations->map(function ($variation) {
            return [
                'id' => $variation->id,
                'attributes' => $variation->attributes, // Already cast to array in the model
                'price' => $variation->price,
                'sale_price' => $variation->sale_price,
                'stock_quantity' => $variation->stock_quantity,
            ];
        }));
    }
}
