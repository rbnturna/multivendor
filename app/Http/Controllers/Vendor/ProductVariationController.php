<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variation;
use Illuminate\Http\Request;


class ProductVariationController extends Controller
{
    public function index()
    {
        $products = Product::with('variations')->get();
        $attributes = Attribute::with('values')->get();
        return view('vendor.variations.index', compact('products', 'attributes'));
    }

    public function createByProduct($id)
    {
        $attributes = Attribute::with('values')->get();
        return view('vendor.product.variations.create', compact('attributes','id'));
    }

    public function storeByProduct(Request $request,$id)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_quantity' => 'required|integer|min:0',
            'attributes' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('variations', 'public');
        }
        $data['product_id'] = $id;

        $variation = new Variation($data);
        $variation->save();

        return redirect()->route('vendor.products.edit',$id)->with('success', 'Variation created successfully!');
    }
    // EditByProduct Controller Method
    public function editByProduct($id, $variationId)
    {
        $variation = Variation::findOrFail($variationId);
        $attributes = Attribute::with('values')->get();

        return view('vendor.product.variations.edit', compact('variation', 'attributes', 'id'));
    }
        // UpdateByProduct Controller Method
    public function updateByProduct(Request $request, $id, $variationId)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_quantity' => 'required|integer|min:0',
            'attributes' => 'required|array',
        ]);

        $variation = Variation::findOrFail($variationId);

        if ($request->hasFile('image')) {
            if ($variation->image) {
                Storage::disk('public')->delete($variation->image);
            }
            $data['image'] = $request->file('image')->store('variations', 'public');
        }

        $variation->update($data);

        return redirect()->route('vendor.products.edit', $id)->with('success', 'Variation updated successfully!');
    }




    public function create()
    {
        $attributes = Attribute::with('values')->get();
        $products = Product::all(); // Fetch products for dropdown
        return view('vendor.variations.create', compact('attributes', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_quantity' => 'required|integer|min:0',
            'attributes' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('variations', 'public');
        }

        $variation = new Variation($data);
        $variation->save();

        return redirect()->route('vendor.variations.index')->with('success', 'Variation created successfully!');
    }

    public function destroy($id)
    {
        $variation = Variation::findOrFail($id);

        // Delete images
        Storage::disk('public')->delete($variation->image);
        // foreach (json_decode($variation->image, true) as $galleryImage) {
            // Storage::disk('public')->delete($variation->image);
        // }

        $variation->delete();
        return redirect()->route('vendor.products.edit',$id)->with('success', 'Variant deleted successfully!');
        //return response()->json(['message' => 'Product deleted successfully']);
    }

    // Attribute Management

    public function manageAttributes()
    {
        $attributes = Attribute::with('values')->get();
        return view('vendor.attributes.index', compact('attributes'));
    }

    public function createAttribute()
    {
        return view('vendor.attributes.create');
    }

    public function storeAttribute(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',
        ]);

        $attribute = Attribute::create(['name' => $data['name']]);
        foreach ($data['values'] as $value) {
            $attribute->values()->create(['value' => $value]);
        }

        return redirect()->route('vendor.attributes.index')->with('success', 'Attribute created successfully!');
    }

    public function editAttribute(Attribute $attribute)
    {
        $attribute->load('values');
        return view('vendor.attributes.edit', compact('attribute'));
    }

    public function updateAttribute(Request $request, Attribute $attribute)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',
        ]);

        $attribute->update(['name' => $data['name']]);
        $attribute->values()->delete();
        foreach ($data['values'] as $value) {
            $attribute->values()->create(['value' => $value]);
        }

        return redirect()->route('vendor.attributes.index')->with('success', 'Attribute updated successfully!');
    }

    public function destroyAttribute(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('vendor.attributes.index')->with('success', 'Attribute deleted successfully!');
    }
}
