<?php

namespace Tests\Feature;

use App\Models\UserAccount;
use App\Models\History;
use App\Models\Skor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_dashboard_for_logged_in_user()
    {
        // Buat user dummy dan login
        $user = UserAccount::factory()->create();
        $this->actingAs($user);

        // Buat skor dummy
        $skor = Skor::factory()->create([
            'emission_km' => 10,
            'emission_kwh' => 20,
            'emission_food' => 5,
        ]);

        // Buat history dummy untuk user yang login
        History::factory()->create([
            'user_id' => $user->id,
            'skor_id' => $skor->id,
            'created_at' => now(),
        ]);

        // Buat history dummy untuk user lain
        $otherUser = UserAccount::factory()->create();
        History::factory()->create([
            'user_id' => $otherUser->id,
            'skor_id' => $skor->id,
            'created_at' => now(),
        ]);

        // Lakukan request ke dashboard
        $response = $this->get(route('dashboard.index'));

        // Periksa apakah response berhasil dan menampilkan data history
        $response->assertStatus(200);
        $response->assertViewHas('latestSkor'); // Periksa apakah view memiliki variabel latestSkor
        $response->assertViewHas('histories');  // Periksa apakah view memiliki variabel histories
    }
}
