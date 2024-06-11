<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "image",
        "status",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
    ];

    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    // public function updater()
    // {
    //     return $this->belongsTo(User::class, 'updated_by');
    // }

}
