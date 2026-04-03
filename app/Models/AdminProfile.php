<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    protected $table = 'admin_profiles';

    protected $fillable = [
        'user_id',
        'admin_level',
        'permissions',
        'department',
        'job_title',
        'created_by_id',
        'notes',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    // AdminProfile belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get admin who created this admin
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // Check if admin has specific permission
    public function hasPermission($permission)
    {
        if (!$this->permissions) {
            return false;
        }
        return in_array($permission, $this->permissions);
    }

    // Check admin level
    public function isSuperAdmin()
    {
        return $this->admin_level === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->admin_level === 'admin';
    }

    public function isModerator()
    {
        return $this->admin_level === 'moderator';
    }
}
