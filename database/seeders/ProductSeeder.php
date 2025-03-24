<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ube Cake
        $ubeCake = Product::create([
            'name' => 'Ube Cake',
            'description' => 'A moist and flavorful cake made with ube (purple yam).',
            'price' => 25.00,
            'stock_quantity' => 10,
            'category' => 'Cakes',
        ]);
        ProductImage::create([
            'product_id' => $ubeCake->product_id, // Access the ID after creation
            'path' => 'images/ube_cake.jpg',
        ]);

        // Chocolate Cake
        $chocolateCake = Product::create([
            'name' => 'Chocolate Cake',
            'description' => 'A rich and decadent chocolate cake.',
            'price' => 30.00,
            'stock_quantity' => 8,
            'category' => 'Cakes',
        ]);
        ProductImage::create([
            'product_id' => $chocolateCake->product_id, // Access the ID after creation
            'path' => 'images/chocolate_cake.png',
        ]);

        // Chocolate Chip Cookies
        $chocolateChipCookies = Product::create([
            'name' => 'Chocolate Chip Cookies',
            'description' => 'Classic chocolate chip cookies, baked to perfection.',
            'price' => 10.00,
            'stock_quantity' => 20,
            'category' => 'Cookies',
        ]);
        ProductImage::create([
            'product_id' => $chocolateChipCookies->product_id, // Access the ID after creation
            'path' => 'images/cookies.jpg',
        ]);

        // Fudge Brownies
        $fudgeBrownies = Product::create([
            'name' => 'Fudge Brownies',
            'description' => 'Rich and fudgy brownies, perfect for any chocolate lover.',
            'price' => 15.00,
            'stock_quantity' => 15,
            'category' => 'Brownies',
        ]);
        ProductImage::create([
            'product_id' => $fudgeBrownies->product_id, // Access the ID after creation
            'path' => 'images/brownies.jpg',
        ]);

        // Vanilla Cupcakes
        $vanillaCupcakes = Product::create([
            'name' => 'Vanilla Cupcakes',
            'description' => 'Delicious vanilla cupcakes with creamy frosting.',
            'price' => 12.00,
            'stock_quantity' => 18,
            'category' => 'Cupcakes',
        ]);
        ProductImage::create([
            'product_id' => $vanillaCupcakes->product_id, // Access the ID after creation
            'path' => 'images/cupcake.jpg',
        ]);

        // Red Velvet Cupcakes
        $redVelvetCupcakes = Product::create([
            'name' => 'Red Velvet Cupcakes',
            'description' => 'Classic red velvet cupcakes with cream cheese frosting.',
            'price' => 14.00,
            'stock_quantity' => 12,
            'category' => 'Cupcakes',
        ]);
        ProductImage::create([
            'product_id' => $redVelvetCupcakes->product_id,
            'path' => 'images/cupcake.jpg',
        ]);

        // Oatmeal Raisin Cookies
        $oatmealRaisinCookies = Product::create([
            'name' => 'Oatmeal Raisin Cookies',
            'description' => 'Soft and chewy oatmeal cookies with plump raisins.',
            'price' => 11.00,
            'stock_quantity' => 25,
            'category' => 'Cookies',
        ]);
        ProductImage::create([
            'product_id' => $oatmealRaisinCookies->product_id,
            'path' => 'images/cookies.jpg',
        ]);

        // Carrot Cake
        $carrotCake = Product::create([
            'name' => 'Carrot Cake',
            'description' => 'Spiced carrot cake with cream cheese frosting.',
            'price' => 35.00,
            'stock_quantity' => 7,
            'category' => 'Cakes',
        ]);
        ProductImage::create([
            'product_id' => $carrotCake->product_id,
            'path' => 'images/ube_cake.jpg',
        ]);

        // Lemon Bars
        $lemonBars = Product::create([
            'name' => 'Lemon Bars',
            'description' => 'Tangy lemon bars with a buttery shortbread crust.',
            'price' => 13.00,
            'stock_quantity' => 16,
            'category' => 'Bars',
        ]);
        ProductImage::create([
            'product_id' => $lemonBars->product_id,
            'path' => 'images/brownies.jpg',
        ]);

        // Peanut Butter Brownies
        $peanutButterBrownies = Product::create([
            'name' => 'Peanut Butter Brownies',
            'description' => 'Fudgy brownies swirled with creamy peanut butter.',
            'price' => 16.00,
            'stock_quantity' => 14,
            'category' => 'Brownies',
        ]);
        ProductImage::create([
            'product_id' => $peanutButterBrownies->product_id,
            'path' => 'images/brownies.jpg',
        ]);
    }
}
