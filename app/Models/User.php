<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = [
        'address_detail_id',
        'name',
        'email',
        'phone',
        'user_code',
        'username',
        'password',
        'photo_thumbs',
        'status',
        'at_active',
        'is_admin',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that should be hidden for serialization
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     /**
     * The attributes that should be hidden for serialization
     *
     * @var array<string, string>
     */
    protected $casts =[
        'password'=>'hashed',
    ];

    protected function is_admin() : Attribute
    {
        return new Attribute(
            get: fn($value) => ["user","admin"][$value],
        );
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class);
    }
}
