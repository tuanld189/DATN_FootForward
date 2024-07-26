<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'fullname',
        'phone',
        'province_id',
        'district_id',
        'wand_id',
        'address',
        'birthday',
        'photo_thumbs',
        'status',
        'email',
        'user_code',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($q) use ($permission) {
            $q->where('name', $permission);
        })->exists();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_code = Str::random(10); // Tạo chuỗi ngẫu nhiên độ dài 10 ký tự
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}


