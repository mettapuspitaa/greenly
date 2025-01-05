<?php

namespace Tests\Feature;

use App\Models\History;
use App\Models\Skor;
use App\Models\UserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class LeaderboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_leaderboard_with_top_10_histories()
    {
        
        // Buat user dummy dan login
        $loginuser = UserAccount::factory()->create();
        $this->actingAs($loginuser);
        // Create 15 users with histories
        $users = UserAccount::factory()->count(15)->create();

        $users->each(function ($user) {
            // Create skor model for each user
            $skor = Skor::factory()->create([
                'emission_km' => rand(1, 100),
                'emission_kwh' => rand(1, 100),
                'emission_food' => rand(1, 100),
            ]);

            // Create history for today with the skor
            History::factory()->create([
                'user_id' => $user->id,
                'skor_id' => $skor->id,
                'created_at' => Carbon::today(),
            ]);
        });

        // Send GET request to the leaderboard endpoint
        $response = $this->get('/leaderboard');

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert that 10 histories are returned in the view
        $response->assertViewHas('histories', function ($histories) {
            return $histories->count() === 10;
        });

        // Assert the top history has the correct structure
        $this->assertNotEmpty($response->viewData('histories')->first()->user);
        $this->assertNotEmpty($response->viewData('histories')->first()->skor);
    }
}
