<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'phone', 'email', 'country_id'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

}
