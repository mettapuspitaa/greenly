<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryCarbonFootprint;
class Skor extends Model
{
    protected $table = 'skor';
    protected $primaryKey = 'skor_id';
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
        return $this->hasMany(HistoryCarbonFootprint::class, 'skor_id');
    }
}
