<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\History;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Skor extends Model
{
    use HasFactory;

    protected $table = 'skor';

    protected $fillable = [
        'emission_km',
        'emission_kwh',
        'emission_food',
        'food',
        'energy',
        'transport',
    ];    

    public function history()
    {
        return $this->hasMany(History::class, 'skor_id');
    }
}
