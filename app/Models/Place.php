<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;
    protected $table = 'places';
    protected $fillable = [
        'image',
        'name_place',
        'location',
        'content',
        'rating',
        'slug',
        'description',
        'keywords',
    ];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($place) {
            $place->slug = Str::slug($place->name_place);
        });
    }
}
