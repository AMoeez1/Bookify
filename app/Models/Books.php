<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Books extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'slug',
        'author_id',
        'description',
        'thumbnail',
        'file',
        'author_name',
        'feat_author'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            $book->slug = Str::slug($book->name);
        });

        static::updating(function ($book) {
            $book->slug = Str::slug($book->name);
        });
    }
}
