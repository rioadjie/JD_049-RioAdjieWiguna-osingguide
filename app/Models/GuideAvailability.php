<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideAvailability extends Model
{
    use HasFactory;
    protected $fillable = [
        'guide_id',
        'date',
        'status', // available, unavailable
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }
}
