<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Cheesecake', 'cheesecake', 'Cheesecake lembut dan creamy.', 'images/cheesecake.jpg', 28000, 12],
            ['Cinnamon Roll', 'cinnamon-roll', 'Roti gulung kayu manis dengan aroma khas.', 'images/cinnamon-roll.jpg', 18000, 15],
            ['Coffee Latte', 'coffee-latte', 'Perpaduan espresso dan susu yang creamy.', 'images/coffee-latte.jpg', 22000, 20],
            ['Croissant', 'croissant', 'Pastry renyah dengan lapisan yang lembut.', 'images/croissant.jpg', 16000, 15],
            ['Donat', 'donat', 'Donat lembut untuk teman santai.', 'images/donat.jpg', 10000, 20],
            ['Matcha Latte', 'matcha-latte', 'Minuman matcha dengan susu yang lembut.', 'images/matcha-latte.jpg', 23000, 20],
            ['Orange Juice', 'orange-juice', 'Jus jeruk segar dengan rasa manis asam.', 'images/orange-juice.jpg', 15000, 15],
            ['Pancake', 'pancake', 'Pancake lembut dengan topping manis.', 'images/pancake.jpg', 22000, 12],
            ['Red Velvet', 'red-velvet', 'Kue red velvet dengan tekstur lembut.', 'images/red-velvet.jpg', 28000, 12],
            ['Roti Cokelat', 'roti-cokelat', 'Roti lembut dengan isian cokelat.', 'images/roti-cokelat.jpg', 12000, 20],
            ['Strawberry Cake', 'strawberry-cake', 'Kue manis dengan rasa stroberi.', 'images/strawberry-cake.jpg', 30000, 12],
            ['Taro Latte', 'taro', 'Minuman taro creamy dengan rasa khas.', 'images/taro.jpg', 22000, 20],
            ['Waffle', 'waffle', 'Waffle hangat dengan tekstur renyah.', 'images/waffle.jpg', 20000, 12],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['slug' => $item[1]],
                [
                    'name' => $item[0],
                    'description' => $item[2],
                    'image' => $item[3],
                    'price' => $item[4],
                    'stock' => $item[5],
                    'is_available' => true,
                ]
            );
        }
    }
}
