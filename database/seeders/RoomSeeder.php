<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Rose Room',
                'rent' => 1000000,
                'short_code' => 'ROSE',
                'number_of_rooms' => 1,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Lily Room',
                'rent' => 1500000,
                'short_code' => 'LILY',
                'number_of_rooms' => 2,
                'room_type' => 'Ballroom',
                'status' => 'Active',
            ],
            [
                'name' => 'Orchid Room',
                'rent' => 2000000,
                'short_code' => 'ORCH',
                'number_of_rooms' => 1,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Tulip Room',
                'rent' => 1200000,
                'short_code' => 'TULI',
                'number_of_rooms' => 3,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Daisy Room',
                'rent' => 1800000,
                'short_code' => 'DAIS',
                'number_of_rooms' => 2,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Sunflower Room',
                'rent' => 2200000,
                'short_code' => 'SUNF',
                'number_of_rooms' => 1,
                'room_type' => 'Ballroom',
                'status' => 'Active',
            ],
            [
                'name' => 'Jasmine Room',
                'rent' => 1600000,
                'short_code' => 'JASM',
                'number_of_rooms' => 2,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Lavender Room',
                'rent' => 1900000,
                'short_code' => 'LAVE',
                'number_of_rooms' => 1,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
            [
                'name' => 'Peony Room',
                'rent' => 2100000,
                'short_code' => 'PEON',
                'number_of_rooms' => 2,
                'room_type' => 'Ballroom',
                'status' => 'Active',
            ],
            [
                'name' => 'Cherry Blossom Room',
                'rent' => 2500000,
                'short_code' => 'CHER',
                'number_of_rooms' => 3,
                'room_type' => 'Meeting',
                'status' => 'Active',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
