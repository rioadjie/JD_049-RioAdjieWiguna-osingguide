<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'booking_code',
        'guide_id',
        'guide_profile_id',
        'start_time',
        'end_time',
        'total_days',
        'number_of_travelers',
        'destination',
        'notes',
        'status',
        'guide_daily_rate',
        'sub_total',
        'platform_fee',
        'total_price',
        'fee_type',
        'fee_value',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relasi
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function guideProfile()
    {
        return $this->belongsTo(GuideProfile::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
