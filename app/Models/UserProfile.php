<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'bio',
        'date_of_birth',
        'gender',
        'alternative_phone',
        'emergency_contact',
        'email_notifications',
        'sms_notifications',
        'push_notifications',
        'status',
        'suspension_reason',
        'suspended_at',
        'preferred_language',
        'timezone',
        'last_login_ip',
        'last_login_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean',
        'push_notifications' => 'boolean',
        'suspended_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    // UserProfile belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if user is active
    public function isActive()
    {
        return $this->status === 'active';
    }
}
