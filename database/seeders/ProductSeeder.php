<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'shoes' => 'Shoes',
            'tshirts' => 'Tshirts',
            'pants' => 'Pants',
            'hoodie' => 'Hoodie',
            'outer' => 'Outer',
            'jackets' => 'Jackets',
            'accessories' => 'Accessories',
        ];

        $categoryMap = [];

        foreach ($categories as $slug => $name) {
            $categoryMap[$slug] = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => "Shop page category: {$name}",
                ]
            );
        }

        $shopProducts = [
            ['name' => 'Half sleeve T-shirt', 'price' => 40.00, 'image' => 'images/selling-products1.jpg', 'category' => 'tshirts'],
            ['name' => 'Stylish Grey T-shirt', 'price' => 35.00, 'image' => 'images/selling-products2.jpg', 'category' => 'tshirts'],
            ['name' => 'Silk White Shirt', 'price' => 35.00, 'image' => 'images/selling-products3.jpg', 'category' => 'tshirts'],
            ['name' => 'Grunge Hoodie', 'price' => 30.00, 'image' => 'images/selling-products4.jpg', 'category' => 'hoodie'],
            ['name' => 'Full sleeve Jeans jacket', 'price' => 40.00, 'image' => 'images/selling-products5.jpg', 'category' => 'jackets'],
            ['name' => 'Grey Check Coat', 'price' => 30.00, 'image' => 'images/selling-products6.jpg', 'category' => 'outer'],
            ['name' => 'Long Sleeve T-shirt', 'price' => 40.00, 'image' => 'images/selling-products7.jpg', 'category' => 'tshirts'],
            ['name' => 'Half Sleeve T-shirt', 'price' => 35.00, 'image' => 'images/selling-products8.jpg', 'category' => 'tshirts'],
            ['name' => 'Orange white Nike', 'price' => 55.00, 'image' => 'images/selling-products13.jpg', 'category' => 'shoes'],
            ['name' => 'Running Shoe', 'price' => 65.00, 'image' => 'images/selling-products14.jpg', 'category' => 'shoes'],
            ['name' => 'Tennis Shoe', 'price' => 80.00, 'image' => 'images/selling-products15.jpg', 'category' => 'shoes'],
            ['name' => 'Nike Brand Shoe', 'price' => 65.00, 'image' => 'images/selling-products16.jpg', 'category' => 'shoes'],
            ['name' => 'White Half T-shirt', 'price' => 30.00, 'image' => 'images/selling-products8.jpg', 'category' => 'tshirts'],
            ['name' => 'Ghee Half T-shirt', 'price' => 40.00, 'image' => 'images/selling-products5.jpg', 'category' => 'tshirts'],
            ['name' => 'Stylish Grey Pant', 'price' => 40.00, 'image' => 'images/selling-products2.jpg', 'category' => 'pants'],
            ['name' => 'White Hoodie', 'price' => 40.00, 'image' => 'images/selling-products17.jpg', 'category' => 'hoodie'],
            ['name' => 'Navy Blue Hoodie', 'price' => 45.00, 'image' => 'images/selling-products4.jpg', 'category' => 'hoodie'],
            ['name' => 'Dark Green Hoodie', 'price' => 35.00, 'image' => 'images/selling-products18.jpg', 'category' => 'hoodie'],
            ['name' => 'Full Sleeve Jeans Jacket', 'price' => 40.00, 'image' => 'images/selling-products5.jpg', 'category' => 'jackets'],
            ['name' => 'Stylish Grey Coat', 'price' => 35.00, 'image' => 'images/selling-products2.jpg', 'category' => 'jackets'],
            ['name' => 'Stylish Women Bag', 'price' => 35.00, 'image' => 'images/selling-products19.jpg', 'category' => 'accessories'],
            ['name' => 'Stylish Gadgets', 'price' => 30.00, 'image' => 'images/selling-products20.jpg', 'category' => 'accessories'],
            ['name' => 'Blue Jeans pant', 'price' => 35.00, 'image' => 'images/selling-products2.jpg', 'category' => 'pants'],
        ];

        foreach ($shopProducts as $index => $item) {
            $slug = Str::slug($item['name']);
            $category = $categoryMap[$item['category']];

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'slug' => $slug,
                    'subtitle' => $category->name,
                    'description' => "{$item['name']} from the {$category->name} collection.",
                    'price' => $item['price'],
                    'volume' => 'Standard',
                    'image' => $item['image'],
                    'images' => [$item['image']],
                    'colors' => ['#000000', '#333333', '#f5f5f5'],
                    'category' => $category->name,
                    'ingredients' => 'N/A',
                    'care_instructions' => 'Store in a clean, dry place and avoid direct sunlight.',
                    'stock' => 20 + ($index % 30),
                    'in_stock' => true,
                    'is_variable' => false,
                ]
            );
        }
    }
}
