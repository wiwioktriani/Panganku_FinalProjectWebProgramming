<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_donation_id',
        'quantity',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foodDonation(): BelongsTo
    {
        return $this->belongsTo(FoodDonation::class, 'food_donation_id');
    }
}
