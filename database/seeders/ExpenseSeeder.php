<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'supplier_name' => 'Aurora Global Supplies',
                'description'   => 'Meja Meeting',
                'date'          => '2024-01-01',
                'item_total'    => 10,
                'amount'        => 10 * 450000, // 4,500,000
            ],
            [
                'supplier_name' => 'Nova International',
                'description'   => 'Kursi Lipat',
                'date'          => '2024-01-02',
                'item_total'    => 25,
                'amount'        => 25 * 125000, // 3,125,000
            ],
            [
                'supplier_name' => 'Cosmo Furnishings',
                'description'   => 'Sound System',
                'date'          => '2024-01-03',
                'item_total'    => 3,
                'amount'        => 3 * 2750000, // 8,250,000
            ],
            [
                'supplier_name' => 'Zenith Tech Supplies',
                'description'   => 'Projector',
                'date'          => '2024-01-04',
                'item_total'    => 4,
                'amount'        => 4 * 1500000, // 6,000,000
            ],
            [
                'supplier_name' => 'Stellar Imports',
                'description'   => 'Whiteboard',
                'date'          => '2024-01-05',
                'item_total'    => 8,
                'amount'        => 8 * 300000, // 2,400,000
            ],
            [
                'supplier_name' => 'Global Sound Systems',
                'description'   => 'Microphone Wireless',
                'date'          => '2024-01-06',
                'item_total'    => 6,
                'amount'        => 6 * 600000, // 3,600,000
            ],
            [
                'supplier_name' => 'Apex Computing Solutions',
                'description'   => 'Laptop Meeting',
                'date'          => '2024-01-07',
                'item_total'    => 5,
                'amount'        => 5 * 7500000, // 37,500,000
            ],
            [
                'supplier_name' => 'Quantum Visuals',
                'description'   => 'TV LED 50 inch',
                'date'          => '2024-01-08',
                'item_total'    => 2,
                'amount'        => 2 * 4500000, // 9,000,000
            ],
            [
                'supplier_name' => 'Electro Connect',
                'description'   => 'Kabel Ekstensi',
                'date'          => '2024-01-09',
                'item_total'    => 15,
                'amount'        => 15 * 50000, // 750,000
            ],
            [
                'supplier_name' => 'Visionary Office',
                'description'   => 'Flipchart',
                'date'          => '2024-01-10',
                'item_total'    => 7,
                'amount'        => 7 * 400000, // 2,800,000
            ],
            [
                'supplier_name' => 'Infinity Branding',
                'description'   => 'Standing Banner',
                'date'          => '2024-01-11',
                'item_total'    => 10,
                'amount'        => 10 * 150000, // 1,500,000
            ],
            [
                'supplier_name' => 'Dynamic Beverage',
                'description'   => 'Air Mineral Botol',
                'date'          => '2024-01-12',
                'item_total'    => 200,
                'amount'        => 200 * 3000, // 600,000
            ],
            [
                'supplier_name' => 'Prime Snacks Ltd.',
                'description'   => 'Snack Box',
                'date'          => '2024-01-13',
                'item_total'    => 50,
                'amount'        => 50 * 15000, // 750,000
            ],
            [
                'supplier_name' => 'Elite Office Supplies',
                'description'   => 'ATK (Alat Tulis Kantor)',
                'date'          => '2024-01-14',
                'item_total'    => 100,
                'amount'        => 100 * 5000, // 500,000
            ],
            [
                'supplier_name' => 'Pure Hygiene International',
                'description'   => 'Hand Sanitizer',
                'date'          => '2024-01-15',
                'item_total'    => 20,
                'amount'        => 20 * 25000, // 500,000
            ],
            [
                'supplier_name' => 'SonicWave Global',
                'description'   => 'Wireless Microphone',
                'date'          => '2024-01-16',
                'item_total'    => 5,
                'amount'        => 5 * 800000, // 4,000,000
            ],
            [
                'supplier_name' => 'Lumina Displays',
                'description'   => 'LED Panel Display',
                'date'          => '2024-01-17',
                'item_total'    => 2,
                'amount'        => 2 * 3500000, // 7,000,000
            ],
            [
                'supplier_name' => 'ProAudio Systems',
                'description'   => 'Portable PA System',
                'date'          => '2024-01-18',
                'item_total'    => 3,
                'amount'        => 3 * 4200000, // 12,600,000
            ],
            [
                'supplier_name' => 'Regal Conference Solutions',
                'description'   => 'Conference Table Set',
                'date'          => '2024-01-19',
                'item_total'    => 1,
                'amount'        => 1 * 15000000, // 15,000,000
            ],
            [
                'supplier_name' => 'Summit Presentations',
                'description'   => 'Podium for Speaker',
                'date'          => '2024-01-20',
                'item_total'    => 3,
                'amount'        => 3 * 750000, // 2,250,000
            ],
            [
                'supplier_name' => 'Directional Acoustics',
                'description'   => 'Directional Microphones',
                'date'          => '2024-01-21',
                'item_total'    => 4,
                'amount'        => 4 * 500000, // 2,000,000
            ],
            [
                'supplier_name' => 'ErgoTech Accessories',
                'description'   => 'Laptop Stand',
                'date'          => '2024-01-22',
                'item_total'    => 10,
                'amount'        => 10 * 250000, // 2,500,000
            ],
            [
                'supplier_name' => 'Vista Cam Corp.',
                'description'   => 'Video Conferencing Camera',
                'date'          => '2024-01-23',
                'item_total'    => 2,
                'amount'        => 2 * 5500000, // 11,000,000
            ],
            [
                'supplier_name' => 'Interactive Vision',
                'description'   => 'Interactive Whiteboard',
                'date'          => '2024-01-24',
                'item_total'    => 2,
                'amount'        => 2 * 8000000, // 16,000,000
            ],
            [
                'supplier_name' => 'Mobile Projection Inc.',
                'description'   => 'Portable Projector',
                'date'          => '2024-01-25',
                'item_total'    => 3,
                'amount'        => 3 * 4500000, // 13,500,000
            ],
        ];

        foreach ($data as $expense) {
            Expense::create($expense);
        }
    }
}
