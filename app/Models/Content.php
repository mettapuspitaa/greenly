<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';
    protected $primaryKey = 'content_id'; // Ensure this is the correct column
    protected $fillable = ['name', 'description', 'path', 'date'];
}
