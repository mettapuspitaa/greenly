<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this class

class UserAccount extends Authenticatable
{
    use HasFactory;

    protected $table = 'useraccount';
    protected $fillable = ['name', 'email', 'password', 'skordaily', 'role'];
}
