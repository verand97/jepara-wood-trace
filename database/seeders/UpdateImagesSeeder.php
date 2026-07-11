<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class UpdateImagesSeeder extends Seeder
{
    public function run()
    {
        $map = [
            1 => 'relief-ramayana.png',
            2 => 'relief-bunga.png',
            3 => 'relief-kaligrafi.png',
        ];

        foreach ($map as $id => $image) {
            $product = Product::find($id);
            if ($product) {
                $product->images = [$image];
                $product->save();
            }
        }
    }
}
