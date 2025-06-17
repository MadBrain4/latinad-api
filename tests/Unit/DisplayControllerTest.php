<?php

namespace Tests\Feature;

use App\Models\Display;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DisplayControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_filtered_and_sorted_results()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Display::factory()->create([
            'name' => 'Pantalla Z',
            'type' => 'indoor',
            'user_id' => $user->id,
        ]);

        Display::factory()->create([
            'name' => 'Pantalla A',
            'type' => 'indoor',
            'user_id' => $user->id,
        ]);

        $response = $this->getJson('/api/displays?type=indoor&sort=name');

        $response->assertStatus(200)
            ->assertJsonPath('data.0.name', 'Pantalla A')
            ->assertJsonPath('data.1.name', 'Pantalla Z');
    }
}
