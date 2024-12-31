<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\History;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SkorC extends Model
{
    use HasFactory;

    protected $table = 'skor';
    protected $primaryKey = 'skor_id'; // Primary key diubah
    public $incrementing = true; // Pastikan jika primary key bersifat auto-increment
    protected $keyType = 'int'; // Jika tipe data integer

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
        return $this->belongsTo(History::class, 'skor_id');
    }
}
