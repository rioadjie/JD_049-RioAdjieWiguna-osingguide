<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value'];

    /**
     * Ambil nilai setting berdasarkan key
     */
    public static function getValue($key)
    {
        return static::where('key', $key)->value('value') ?? null;
    }
}
