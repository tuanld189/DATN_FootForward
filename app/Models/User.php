<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_code',
        'username',
        'password',
        'photo_thumbs',
        'status',
        'at_active',
        'created_at',
        'updated_at',
    ];
}
