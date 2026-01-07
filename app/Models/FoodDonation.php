<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodDonation extends Model
{
    use HasFactory;

    // Fillable sesuai kolom di DB
    protected $fillable = [
        'user_id',
        'category_id',    // <-- sesuai nama kolom di tabel
        'food_name',
        'quantity',
        'expired_at',
        'description',
        'status',
    ];

    // Cast date biar ->format() jalan
    protected $casts = [
        'expired_at' => 'date',   // ini yang fix error format() on string
        'status'     => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foodRequests(): HasMany
    {
        return $this->hasMany(FoodRequest::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'category_id');
    }
}
