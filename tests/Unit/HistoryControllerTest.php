<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UserAccount;
use App\Models\History;
use App\Models\Skor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_history_for_logged_in_user()
    {
        // Arrange: Buat user dan data history
        $user = UserAccount::factory()->create();
        $skor = Skor::factory()->create();
        History::factory()->create([
            'user_id' => $user->id,
            'skor_id' => $skor->id,
        ]);

        // Act: Login user dan akses halaman history
        $this->actingAs($user)
             ->get(route('user.history'))
             ->assertStatus(200)
             ->assertViewHas('histories', function ($histories) use ($user) {
                 // Assert: Pastikan hanya history milik user yang ditampilkan
                 return $histories->first()->user_id === $user->id;
             });
    }

    /** @test */
    public function it_returns_empty_view_when_no_history_exists_for_user()
    {
        // Arrange: Buat user tanpa data history
        $user = UserAccount::factory()->create();

        // Act: Login user dan akses halaman history
        $this->actingAs($user)
             ->get(route('user.history'))
             ->assertStatus(200)
             ->assertViewHas('histories', function ($histories) {
                 // Assert: Pastikan history kosong
                 return $histories->isEmpty();
             });
    }
}
