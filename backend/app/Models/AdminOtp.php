<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminOtp extends Model
{
    protected $fillable = ['email', 'code', 'expires_at', 'used', 'attempts'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function isValid(): bool
    {
        return !$this->used
            && $this->expires_at->isFuture()
            && $this->attempts < (int) config('auth.otp_max_attempts', 5);
    }

    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }
}
