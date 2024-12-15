<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emission extends Model
{
    use HasFactory;

    protected $table = 'emission';
    protected $fillable = ['name', 'type', 'emission'];
}
