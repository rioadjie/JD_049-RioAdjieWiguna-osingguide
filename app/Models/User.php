<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\GuideProfile;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Kirim email verifikasi custom.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'guide_id');
    }

    public function guideProfile()
    {
        return $this->hasOne(GuideProfile::class, 'user_id');
    }

    public function bookingsAsGuide()
    {
        return $this->hasMany(Booking::class, 'guide_id');
    }

    public function bookingsAsCustomer()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function availabilities()
    {
        return $this->hasMany(GuideAvailability::class, 'guide_id');
    }
}
