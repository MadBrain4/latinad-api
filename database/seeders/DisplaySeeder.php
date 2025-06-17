<?php

namespace Database\Seeders;

use App\Models\Display;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Display::factory()->count(20)->create();
    }
}
