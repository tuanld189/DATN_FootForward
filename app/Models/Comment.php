<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        // 'post_id',
        'product_id',
        'content',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Quan hệ với người tạo (user)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Quan hệ với người cập nhật (user)
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
