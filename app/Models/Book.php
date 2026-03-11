<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'title', 'author', 'isbn',
        'total_copies', 'available_copies', 'published_at', 'cover_image'
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }
}
