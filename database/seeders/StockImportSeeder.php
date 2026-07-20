<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StockImportSeeder extends Seeder
{
    /**
     * Import products from the Black Fragrance stock list.
     * Missing prices are set to 0 — the user will edit them later via admin panel.
     */
    public function run(): void
    {
        // All unique categories from the stock file
        $categories = [
            'accessories'  => 'Accessories',
            'footwear'     => 'Footwear',
            'innerwear'    => 'InnerWear',
            'gum'          => 'Gum',
            'condom'       => 'Condom',
            'headphones'   => 'Headphones',
            'shave'        => 'Shave',
            'face-mask'    => 'Face Mask',
            'foot-mask'    => 'Foot Mask',
            'body-lotion'  => 'Body Lotion',
            'perfume'      => 'Perfume',
            'watch'        => 'Watch',
            'grooming'     => 'Grooming',
            'clothing'     => 'Clothing',
            'swimwear'     => 'Swimwear',
            'beachwear'    => 'Beachwear',
            'underwear'    => 'Underwear',
            'hats'         => 'Hats',
            'home'         => 'Home & Living',
            'scarves'      => 'Scarves',
        ];

        $categoryMap = [];

        foreach ($categories as $slug => $name) {
            $categoryMap[$slug] = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => "Shop category: {$name}",
                ]
            );
        }

        // Stock data: [name, purchase_price, quantity, sale_price, category_slug]
        // Prices of 0 mean "not yet set" — user will fill them in later.
        $stockProducts = [
            ['Hair Clipper', 12000, 1, 20000, 'accessories'],
            ['HandHeld Iron', 3000, 1, 9000, 'accessories'],
            ['Crocks 12', 5000, 1, 8000, 'footwear'],
            ['Crocks 34', 5000, 1, 10000, 'footwear'],
            ['Bathroom Slippers', 2500, 2, 3500, 'footwear'],
            ['London Singlet', 0, 3, 7000, 'innerwear'],
            ['USR Singlet', 7700, 3, 3500, 'innerwear'],
            ['Kanin Signet', 8400, 3, 5000, 'innerwear'],
            ['Hair Comb', 200, 24, 500, 'accessories'],
            ['Mentors Ice', 280, 13, 500, 'gum'],
            ['Kiss Condom', 320, 10, 3000, 'condom'],
            ['Brown Headset', 5000, 1, 12000, 'headphones'],
            ['Silver Headset', 5000, 1, 12000, 'headphones'],
            ['Apple Headset', 3000, 1, 9000, 'headphones'],
            ['Gillette Blue II', 12960, 10, 0, 'shave'],
            ['Gillette Blue II Plus', 6240, 6, 0, 'shave'],
            ['Hyaluronic Face Mask', 0, 1, 0, 'face-mask'],
            ['Egyptian Mask', 0, 1, 0, 'face-mask'],
            ['Exfoliating Foot Mask', 0, 1, 0, 'foot-mask'],
            ['VHA Foot Mask', 0, 1, 0, 'foot-mask'],
            ['Shea Butter', 0, 1, 0, 'foot-mask'],
            ['Tea Tree Facial Scrub', 0, 1, 0, 'face-mask'],
            ['Pears Baby Oil', 0, 2, 0, 'body-lotion'],
            ['Ear Piece Handsfree', 0, 2, 5000, 'headphones'],
            ['Beau Charm', 0, 2, 2500, 'accessories'],
            ['Hicell AAA Batteries', 0, 2, 0, 'accessories'],
            ['GK Men Perfume', 0, 1, 0, 'perfume'],
            ['Genie Valentino', 0, 1, 0, 'perfume'],
            ['Smart Collection', 1980, 1, 0, 'perfume'],
            ['Versace Enus', 0, 1, 0, 'perfume'],
            ['Face Scrub (N2)', 0, 1, 0, 'face-mask'],
            ['Riggs', 0, 1, 0, 'accessories'],
            ['D96 Plus Watch', 0, 2, 0, 'watch'],
            ['Series 10 Watch', 0, 4, 0, 'watch'],
            ['W9 Ultra', 0, 3, 0, 'watch'],
            ['HK 9 Ultra', 0, 1, 0, 'watch'],
            ['Ultra 7in1', 0, 4, 0, 'watch'],
            ['Male Hair Brush', 1800, 1, 2500, 'grooming'],
            ['Nivea Men', 0, 1, 0, 'grooming'],
            ['Ryan Black 47', 3500, 1, 5000, 'perfume'],
            ['Ryan Black 38', 3500, 1, 5000, 'perfume'],
            ['Gucci Rush', 3130, 1, 0, 'perfume'],
            ['LA Bomb', 0, 1, 0, 'perfume'],
            ['Big Scarf', 0, 12, 12000, 'scarves'],
            ['Small Scarf', 0, 5, 5000, 'scarves'],
            ['Topten White Shirt', 10000, 2, 0, 'clothing'],
            ['Boys Golfers', 5000, 1, 0, 'clothing'],
            ['Hair Clip', 0, 1, 2000, 'accessories'],
            ['Swimming Cap', 0, 2, 0, 'swimwear'],
            ['Swimming Goggles', 0, 9, 0, 'swimwear'],
            ['Shorts', 0, 31, 0, 'clothing'],
            ['Pants', 2000, 23, 6000, 'underwear'],
            ['Bra', 2000, 17, 0, 'underwear'],
            ['Bra and Pant', 0, 5, 0, 'underwear'],
            ['Baseball Cap', 0, 8, 0, 'hats'],
            ['Male Camp Hat', 0, 1, 0, 'hats'],
            ['Female Camp Hat', 0, 2, 0, 'hats'],
            ['Umbrella', 0, 8, 0, 'accessories'],
            ['Scarf', 0, 6, 0, 'scarves'],
            ['Blanket', 0, 2, 0, 'home'],
            ['Robes', 0, 2, 0, 'home'],
            ['Small Towel', 0, 6, 0, 'home'],
            ['Big Towel', 0, 6, 0, 'home'],
            ['Face Towel', 0, 2, 0, 'home'],
            ['Boxers', 0, 12, 1800, 'underwear'],
            ['Bikini', 5000, 4, 10000, 'beachwear'],
            ['Wrap Round 2 Piece', 10000, 6, 20000, 'beachwear'],
            ['Couple Beach Wear', 12000, 6, 40000, 'beachwear'],
            ['Beach Kimono', 12000, 5, 40000, 'beachwear'],
            ['Female 2 Piece With Trouser', 10000, 1, 20000, 'clothing'],
            ['BooHooMan Sleeve', 10000, 3, 20000, 'clothing'],
            ['BooHooMan Shirt', 5000, 1, 17000, 'clothing'],
            ['Checked Shirt', 10000, 1, 35000, 'clothing'],
            ['BooHooMan Jeans', 15000, 2, 30000, 'clothing'],
            ['Female 2 Piece Skirt Jacket', 15000, 4, 40000, 'clothing'],
            ['Male Sunset Beach Shirt', 1000, 1, 25000, 'beachwear'],
        ];

        foreach ($stockProducts as $item) {
            [$name, $purchasePrice, $quantity, $salePrice, $categorySlug] = $item;

            $slug = Str::slug($name);
            $category = $categoryMap[$categorySlug];

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id'       => $category->id,
                    'name'              => $name,
                    'slug'              => $slug,
                    'subtitle'          => $category->name,
                    'description'       => "{$name} — {$category->name} collection.",
                    'price'             => $salePrice,
                    'volume'            => null,
                    'image'             => null,
                    'images'            => null,
                    'colors'            => null,
                    'category'          => $category->name,
                    'ingredients'       => null,
                    'care_instructions' => null,
                    'stock'             => $quantity,
                    'in_stock'          => $quantity > 0,
                    'is_variable'       => false,
                ]
            );
        }

        $this->command->info("✅ Imported " . count($stockProducts) . " products across " . count($categories) . " categories.");
    }
}
