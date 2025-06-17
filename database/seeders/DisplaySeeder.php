<?php

namespace Database\Seeders;

use App\Models\Display;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        if (!$user) {
            throw new \Exception("Usuario de prueba no encontrado.");
        }

        $displays = [
            [
                'name' => 'Pantalla Central',
                'description' => 'Pantalla ubicada en el centro de la ciudad',
                'price_per_day' => 500.00,
                'resolution_height' => 1080,
                'resolution_width' => 1920,
                'type' => 'indoor',
            ],
            [
                'name' => 'Pantalla Costanera',
                'description' => 'Ubicada en la costanera, gran visibilidad',
                'price_per_day' => 750.50,
                'resolution_height' => 1440,
                'resolution_width' => 2560,
                'type' => 'outdoor',
            ],
            [
                'name' => 'Pantalla Mall',
                'description' => 'Pantalla dentro del shopping principal',
                'price_per_day' => 620.00,
                'resolution_height' => 1080,
                'resolution_width' => 1920,
                'type' => 'indoor',
            ],
        ];

        foreach ($displays as $data) {
            $user->displays()->create($data);
        }

        Display::factory()->count(20)->create();
    }
}
