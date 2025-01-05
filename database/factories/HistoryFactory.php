<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\UserAccount;
use App\Models\Skor;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition()
    {
        return [
            'skor_id' => Skor::factory(),  // Membuat data skor secara otomatis
            'user_id' => UserAccount::factory(),  // Membuat data user secara otomatis
            'rekomendasi' => $this->faker->sentence,
            'date' => $this->faker->date(),
        ];
    }
}
