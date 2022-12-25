<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'last_name',
        'middle_name',
        'address',
        'address_id',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Profile $profile) {
            $profile->slug = $profile->slug ?? 'profile'.'-'.str($profile->user_d)->slug();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
