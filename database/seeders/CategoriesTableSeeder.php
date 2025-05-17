<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'parent_id' => null,
                'name' => 'Men Fashion',
                'slug' => Str::slug('Men Fashion'),
                'description' => 'Explore the latest trends in men\'s fashion.',
                'image' => 'frontend/img/cat-1.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Men Accessories',
                'slug' => Str::slug('Men Accessories'),
                'description' => 'Stylish accessories to complement your outfit.',
                'image' => 'frontend/img/cat-2.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Watches',
                'slug' => Str::slug('Watches'),
                'description' => 'Premium watches for every occasion.',
                'image' => 'frontend/img/cat-3.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Sunglasses',
                'slug' => Str::slug('Sunglasses'),
                'description' => 'Trendy sunglasses to protect your eyes in style.',
                'image' => 'frontend/img/cat-4.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Belts',
                'slug' => Str::slug('Belts'),
                'description' => 'High-quality belts for a perfect fit.',
                'image' => 'frontend/img/cat-5.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Shoes',
                'slug' => Str::slug('Shoes'),
                'description' => 'Comfortable and stylish footwear for men.',
                'image' => 'frontend/img/cat-6.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'T-Shirts',
                'slug' => Str::slug('T-Shirts'),
                'description' => 'Casual and comfortable t-shirts for men.',
                'image' => 'frontend/img/cat-7.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Jeans',
                'slug' => Str::slug('Jeans'),
                'description' => 'Durable and stylish jeans for men.',
                'image' => 'frontend/img/cat-8.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Formal Wear',
                'slug' => Str::slug('Formal Wear'),
                'description' => 'Elegant formal wear for professional settings.',
                'image' => 'frontend/img/cat-9.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Undergarments',
                'slug' => Str::slug('Undergarments'),
                'description' => 'Comfortable and breathable undergarments.',
                'image' => 'frontend/img/cat-10.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Hats & Caps',
                'slug' => Str::slug('Hats & Caps'),
                'description' => 'Stylish hats and caps for men.',
                'image' => 'frontend/img/cat-11.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Wallets',
                'slug' => Str::slug('Wallets'),
                'description' => 'Premium wallets to keep your essentials organized.',
                'image' => 'frontend/img/cat-12.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Jackets',
                'slug' => Str::slug('Jackets'),
                'description' => 'Warm and stylish jackets for men.',
                'image' => 'frontend/img/cat-13.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Suits',
                'slug' => Str::slug('Suits'),
                'description' => 'Tailored suits for a sharp and professional look.',
                'image' => 'frontend/img/cat-14.jpg',
            ],
            [
                'parent_id' => null,
                'name' => 'Sportswear',
                'slug' => Str::slug('Sportswear'),
                'description' => 'Comfortable and durable sportswear for men.',
                'image' => 'frontend/img/cat-15.jpg',
            ],
        ];

        foreach ($categories as $categoryData) {
            // Create the category
            $category = Category::create($categoryData);

            // Create 5 products under each category
            for ($i = 1; $i <= 5; $i++) {
                $product = Product::create([
                    'name' => $category['name'] . " Product $i",
                    'slug' => Str::slug($category['name'] . " Product $i"),
                    'sku' => strtoupper(Str::random(10)),
                    'image' => 'frontend/img/product-' . rand(1, 8) . '.jpg',
                    'gallery_images' => ['frontend/img/product-' . rand(1, 8) . '.jpg'],
                    'price' => rand(50, 200),
                    'selling_price' => rand(40, 150),
                    'description' => 'This is a description for ' . $category['name'] . " Product $i.",
                    'short_description' => 'Short description for ' . $category['name'] . " Product $i.",
                    'stock' => rand(10, 100),
                    'is_active' => true,
                    'is_featured' => rand(0, 1),
                    'category_id' => $category->id,
                    'vendor_id' => 1, // Assuming vendor_id 1 exists
                    'tax' => rand(5, 15),
                    'weight' => rand(1, 5),
                    'length' => rand(10, 50),
                    'width' => rand(10, 50),
                    'height' => rand(10, 50),
                    'views' => rand(0, 1000),
                    'rating' => rand(1, 5),
                    'total_reviews' => rand(0, 100),
                    'sold' => rand(0, 50),
                    'available_from' => now(),
                    'available_until' => now()->addMonths(6),
                ]);

                // Create 3 variations for each product
                for ($j = 1; $j <= 3; $j++) {
                    Variation::create([
                        'product_id' => $product->id,
                        'price' => $product->price + rand(5, 20),
                        'sale_price' => $product->selling_price - rand(5, 10),
                        'image' => 'frontend/img/product-' . rand(1, 8) . '.jpg',
                        'stock_quantity' => rand(5, 50),
                        'attributes' => json_encode([
                            'size' => 'Size ' . $j,
                            'color' => 'Color ' . $j,
                        ]),
                    ]);
                }

                // Attach the product to multiple categories (many-to-many relationship)
                $product->categories()->attach([$category->id]);
                // Create and attach tags to the product
                $tags = [
                    'New Arrival', 'Best Seller', 'Limited Edition', 'Trending', 'Discounted',
                    'Exclusive', 'Hot Deal', 'Seasonal', 'Popular', 'Featured',
                    'Top Rated', 'On Sale', 'Premium', 'Eco-Friendly', 'Handmade',
                    'Luxury', 'Budget-Friendly', 'Fast Shipping', 'Gift Item', 'Collector\'s Item'
                ];

                // Attach random tags to the product
                $randomTags = collect($tags)->random(rand(3, 6)); // Attach 3 to 6 random tags
                foreach ($randomTags as $tagName) {
                    $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName, 'slug'=>Str::slug($tagName)]);
                    $product->tags()->attach($tag->id);
                }
                

            }
        }
    }
}