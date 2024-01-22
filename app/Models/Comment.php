<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['name', 'email', 'message', 'blog_id', 'status'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
