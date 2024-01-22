<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'introduction',
        'category',
        'description',
        'img',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status', // Assuming status is a boolean field
        'blogger_id',
    ];

    protected $casts = [
        'status' => 'boolean', // Ensure the 'status' attribute is cast as boolean
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title) . '-' . rand(1000, 9999);
        });
    }

    public function blogger()
    {
        return $this->belongsTo(User::class, 'blogger_id');
    }
}
