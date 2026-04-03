<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'title',
        'message',
        'type',
        'related_model',
        'related_id',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Notification belongs to a user (receiver)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Notification may belong to an admin (sender)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Get unread notifications count
    public static function unreadCount($userId)
    {
        return self::where('user_id', $userId)->where('is_read', false)->count();
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }
}
