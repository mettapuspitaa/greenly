<?php

namespace Tests\Feature;

use App\Models\Skor;
use App\Models\History;
use App\Models\UserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_skor_and_history()
    {
        // Buat user dummy dan login
        $user = UserAccount::factory()->create();
        $this->actingAs($user);

        // Data request yang valid
        $data = [
            'emission_km' => 10.5,
            'emission_kwh' => 20.0,
            'emission_food' => 15.5,
            'food' => 'Vegetarian',
            'energy' => 'Solar',
            'transport' => 'Electric car',
            'recommendation' => 'Use more renewable energy',
        ];

        // Lakukan request POST ke endpoint store
        $response = $this->postJson(route('save-skor'), $data);

        // Pastikan response berhasil
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Data saved successfully',
            'skor' => [
                'emission_km' => 10.5,
                'emission_kwh' => 20.0,
                'emission_food' => 15.5,
                'food' => 'Vegetarian',
                'energy' => 'Solar',
                'transport' => 'Electric car',
            ],
        ]);

        // Pastikan data skor tersimpan di database
        $this->assertDatabaseHas('skor', [
            'emission_km' => 10.5,
            'emission_kwh' => 20.0,
            'emission_food' => 15.5,
            'food' => 'Vegetarian',
            'energy' => 'Solar',
            'transport' => 'Electric car',
        ]);

        // Pastikan data history tersimpan di database
        $this->assertDatabaseHas('history_carbon_footprint', [
            'user_id' => $user->id,
            'rekomendasi' => 'Use more renewable energy',
        ]);
    }

    /** @test */
    public function it_validates_the_request_before_storing()
    {
        // Buat user dummy dan login
        $user = UserAccount::factory()->create();
        $this->actingAs($user);

        // Data request yang tidak valid (tanpa field required)
        $data = [
            'emission_km' => '',
            'emission_kwh' => '',
            'emission_food' => '',
        ];

        // Lakukan request POST ke endpoint store
        $response = $this->postJson(route('save-skor'), $data);

        // Pastikan response memiliki status 422 (Unprocessable Entity) karena validasi gagal
        $response->assertStatus(422);

        // Pastikan pesan error terkait field yang divalidasi muncul
        $response->assertJsonValidationErrors([
            'emission_km',
            'emission_kwh',
            'emission_food',
            'food',
            'energy',
            'transport',
            'recommendation',
        ]);
    }
}
