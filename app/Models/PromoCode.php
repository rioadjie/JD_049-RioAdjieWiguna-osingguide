<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'discount_value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
    ];

    public function isExpired()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

    public function isNotStarted()
    {
        return Carbon::now()->isBefore($this->start_date);
    }

    public function isUsageLimitReached()
    {
        return $this->usage_limit && $this->used_count >= $this->usage_limit;
    }

    public function isValid()
    {
        return $this->is_active &&
               !$this->isExpired() &&
               !$this->isNotStarted() &&
               !$this->isUsageLimitReached();
    }

    public function calculateDiscount($amount)
    {
        if ($amount < $this->minimum_amount) {
            return 0;
        }

        $discount = 0;
        if ($this->discount_type === 'percentage') {
            $discount = ($amount * $this->discount_value) / 100;
            if ($this->maximum_discount) {
                $discount = min($discount, $this->maximum_discount);
            }
        } else {
            $discount = $this->discount_value;
        }

        return $discount;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
    }
}
