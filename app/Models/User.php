<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'phone',
        'user_code',
        'username',
        'password',
        'photo_thumbs',
        'status',
        'is_active',
        // 'is_admin',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class,);
    }
}
