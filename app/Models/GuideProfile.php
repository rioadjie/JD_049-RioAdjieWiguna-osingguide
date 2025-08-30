<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'experience',
        'languages', // json: ["Indonesia", "English"]
        'skills',    // json: ["Hiking", "Photography"]
        'daily_rate',
        'max_travelers',
        'level', // junior, intermediate, expert
        'status', // active, inactive (ganti availability jadi status)
        'photo',
        'cv',
    ];

    protected $casts = [
        'languages' => 'array',
        'skills' => 'array',
        'level' => 'string',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
