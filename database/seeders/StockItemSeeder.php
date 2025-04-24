<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockItem;

class StockItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['product_name' => 'Meja Meeting', 'quantity' => 10, 'price' => 450000],
            ['product_name' => 'Kursi Lipat', 'quantity' => 25, 'price' => 125000],
            ['product_name' => 'Sound System', 'quantity' => 3, 'price' => 2750000],
            ['product_name' => 'Projector', 'quantity' => 4, 'price' => 1500000],
            ['product_name' => 'Whiteboard', 'quantity' => 8, 'price' => 300000],
            ['product_name' => 'Microphone Wireless', 'quantity' => 6, 'price' => 600000],
            ['product_name' => 'Laptop Meeting', 'quantity' => 5, 'price' => 7500000],
            ['product_name' => 'TV LED 50 inch', 'quantity' => 2, 'price' => 4500000],
            ['product_name' => 'Kabel Ekstensi', 'quantity' => 15, 'price' => 50000],
            ['product_name' => 'Flipchart', 'quantity' => 7, 'price' => 400000],
            ['product_name' => 'Standing Banner', 'quantity' => 10, 'price' => 150000],
            ['product_name' => 'Air Mineral Botol', 'quantity' => 200, 'price' => 3000],
            ['product_name' => 'Snack Box', 'quantity' => 50, 'price' => 15000],
            ['product_name' => 'ATK (Alat Tulis Kantor)', 'quantity' => 100, 'price' => 5000],
            ['product_name' => 'Hand Sanitizer', 'quantity' => 20, 'price' => 25000],
        ];

        $additionalItems = [
            ['product_name' => 'Wireless Microphone', 'quantity' => 5, 'price' => 800000],
            ['product_name' => 'LED Panel Display', 'quantity' => 2, 'price' => 3500000],
            ['product_name' => 'Portable PA System', 'quantity' => 3, 'price' => 4200000],
            ['product_name' => 'Conference Table Set', 'quantity' => 1, 'price' => 15000000],
            ['product_name' => 'Podium for Speaker', 'quantity' => 3, 'price' => 750000],
            ['product_name' => 'Directional Microphones', 'quantity' => 4, 'price' => 500000],
            ['product_name' => 'Laptop Stand', 'quantity' => 10, 'price' => 250000],
            ['product_name' => 'Video Conferencing Camera', 'quantity' => 2, 'price' => 5500000],
            ['product_name' => 'Interactive Whiteboard', 'quantity' => 2, 'price' => 8000000],
            ['product_name' => 'Portable Projector', 'quantity' => 3, 'price' => 4500000],
        ];

        foreach ($items as $item) {
            StockItem::create($item);
        }

        foreach ($additionalItems as $item) {
            StockItem::create($item);
        }
    }
}
