<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'project_type',
        'preferred_date', 'preferred_time', 'notes',
        'status', 'admin_notes', 'ip_address',
    ];

    protected $casts = ['preferred_date' => 'date'];
}
