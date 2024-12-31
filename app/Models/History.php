<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Skor;
use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $table = 'history_carbon_footprint';

    protected $fillable = [
        'skor_id',
        'user_id',
        'rekomendasi',
        'date',
    ];    

    public function skor()
    {
        return $this->belongsTo(Skor::class);
    }

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }
}