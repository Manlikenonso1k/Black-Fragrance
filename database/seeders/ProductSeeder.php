<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fragranceCategory = Category::firstOrCreate([
            'slug' => 'fragrance',
        ], [
            'name' => 'Fragrance',
            'description' => 'Premium fragrance collections and signature scents.',
        ]);

        $luxuryCategory = Category::firstOrCreate([
            'slug' => 'luxury-collection',
        ], [
            'name' => 'Luxury Collection',
            'description' => 'Limited release and signature luxury fragrance editions.',
        ]);

        $products = [
            [
                'name' => 'Midnight Essence',
                'slug' => 'midnight-essence',
                'subtitle' => 'A sophisticated blend of darkness and depth',
                'description' => 'Midnight Essence captures the mystery of the night with a captivating blend of dark florals and woody notes. This luxurious fragrance opens with fresh bergamot before transitioning into rich, sensual base notes.',
                'price' => 185.00,
                'volume' => '100ml',
                'image' => 'images/selling-products1.jpg',
                'images' => ['images/selling-products1.jpg', 'images/selling-products2.jpg'],
                'colors' => ['#1a1a1a', '#2d2d2d'],
                'category_id' => $luxuryCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Bergamot, Lemon, Pink Pepper',
                'heart_notes' => 'Jasmine, Rose, Iris',
                'base_notes' => 'Sandalwood, Musk, Amber',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Limonene, Linalool, Hexyl Cinnamal',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 45,
                'in_stock' => true,
                'is_variable' => true,
                'variants' => [
                    ['name' => '50ml', 'sku' => 'ME-50', 'volume' => '50ml', 'price' => 125.00, 'stock' => 18, 'is_default' => false],
                    ['name' => '100ml', 'sku' => 'ME-100', 'volume' => '100ml', 'price' => 185.00, 'stock' => 45, 'is_default' => true],
                    ['name' => '150ml', 'sku' => 'ME-150', 'volume' => '150ml', 'price' => 245.00, 'stock' => 9, 'is_default' => false],
                ],
            ],
            [
                'name' => 'Luminous Bliss',
                'slug' => 'luminous-bliss',
                'subtitle' => 'Radiant and effortlessly elegant',
                'description' => 'Luminous Bliss is a bright, airy fragrance designed for the modern romantic. A perfect balance of floral sweetness and crisp citrus notes creates an uplifting scent that lingers throughout the day.',
                'price' => 165.00,
                'volume' => '100ml',
                'image' => 'images/selling-products3.jpg',
                'images' => ['images/selling-products3.jpg'],
                'colors' => ['#f5f5f5', '#e0e0e0'],
                'category_id' => $fragranceCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Neroli, Grapefruit, Peach',
                'heart_notes' => 'Peony, Lily of the Valley, Orchid',
                'base_notes' => 'Musk, Cedarwood, Vanilla',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Geraniol, Limonene, Linalool',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 62,
                'in_stock' => true,
            ],
            [
                'name' => 'Velvet Shadow',
                'slug' => 'velvet-shadow',
                'subtitle' => 'Rich, mysterious, and deeply sensual',
                'description' => 'Velvet Shadow is a bold statement fragrance for those who dare to be different. With deep sandalwood and patchouli, it\'s paired with unexpected floral notes for a modern, luxurious experience.',
                'price' => 195.00,
                'volume' => '100ml',
                'image' => 'images/selling-products5.jpg',
                'images' => ['images/selling-products5.jpg'],
                'colors' => ['#222222', '#1f1f1f'],
                'category_id' => $luxuryCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Black Pepper, Cardamom, Nutmeg',
                'heart_notes' => 'Leather, Oud, Incense',
                'base_notes' => 'Sandalwood, Patchouli, Musk',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Linalool, Geraniol, Eugenol',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 38,
                'in_stock' => true,
            ],
            [
                'name' => 'Crystal Clear',
                'slug' => 'crystal-clear',
                'subtitle' => 'Pure, clean, and utterly refreshing',
                'description' => 'Crystal Clear is the essence of purity, featuring crisp water notes combined with aromatic herbs. It\'s the perfect companion for both work and leisure, offering a clean yet sophisticated scent.',
                'price' => 155.00,
                'volume' => '100ml',
                'image' => 'images/selling-products7.jpg',
                'images' => ['images/selling-products7.jpg'],
                'colors' => ['#ffffff', '#f0f0f0'],
                'category_id' => $fragranceCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Mint, Eucalyptus, Basil',
                'heart_notes' => 'Calone, Muguet, Green Tea',
                'base_notes' => 'Musk, Driftwood, Soapwood',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Carvone, Limonene, Linalool',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 78,
                'in_stock' => true,
            ],
            [
                'name' => 'Golden Hour',
                'slug' => 'golden-hour',
                'subtitle' => 'Warm, luxurious, and timelessly elegant',
                'description' => 'Golden Hour captures the magic of sunset with warm amber, rich vanilla, and precious woods. A truly sophisticated fragrance that transitions beautifully from day to evening.',
                'price' => 175.00,
                'volume' => '100ml',
                'image' => 'images/selling-products9.jpg',
                'images' => ['images/selling-products9.jpg'],
                'colors' => ['#d4af37', '#c9a961'],
                'category_id' => $luxuryCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Blood Orange, Saffron, Pink Pepper',
                'heart_notes' => 'Amber, Heliotrope, Iris',
                'base_notes' => 'Sandalwood, Vetiver, Vanillin',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Limonene, Eugenol, Linalool',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 51,
                'in_stock' => true,
            ],
            [
                'name' => 'Noir Silence',
                'slug' => 'noir-silence',
                'subtitle' => 'Whispers of sophistication',
                'description' => 'Noir Silence is an introspective fragrance that speaks volumes through subtle nuance. A minimalist composition of dark florals and ambient accords creates an aura of quiet luxury.',
                'price' => 200.00,
                'volume' => '100ml',
                'image' => 'images/selling-products11.jpg',
                'images' => ['images/selling-products11.jpg'],
                'colors' => ['#000000', '#1a1a1a'],
                'category_id' => $luxuryCategory->id,
                'category' => 'Fragrance',
                'top_notes' => 'Aldehydes, Pink Pepper, Lemon',
                'heart_notes' => 'Tuberose, Gardenia, Indole',
                'base_notes' => 'Oud, Ambroxan, Musk',
                'ingredients' => 'Alcohol Denat., Fragrance (Parfum), Water (Aqua), Linalool, Geraniol, Coumarin',
                'care_instructions' => 'Store in a cool, dark place. Avoid direct sunlight. Apply to pulse points for best results.',
                'stock' => 25,
                'in_stock' => true,
            ],
        ];

        foreach ($products as $productData) {
            $variants = $productData['variants'] ?? [];

            unset($productData['variants']);

            $product = Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );

            foreach ($variants as $index => $variantData) {
                ProductVariant::updateOrCreate([
                    'sku' => $variantData['sku'],
                ], [
                    'product_id' => $product->id,
                    'name' => $variantData['name'],
                    'sku' => $variantData['sku'],
                    'volume' => $variantData['volume'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'is_default' => $variantData['is_default'],
                    'attributes' => [
                        'index' => $index,
                        'type' => 'volume',
                    ],
                ]);
            }
        }
    }
}
