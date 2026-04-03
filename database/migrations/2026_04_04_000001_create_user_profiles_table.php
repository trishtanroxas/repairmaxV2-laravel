<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Info
            $table->string('bio')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            
            // Contact Info
            $table->string('alternative_phone')->nullable();
            $table->string('emergency_contact')->nullable();
            
            // Account Settings
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('push_notifications')->default(true);
            
            // Status
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('suspension_reason')->nullable();
            $table->timestamp('suspended_at')->nullable();
            
            // Preferences
            $table->string('preferred_language')->default('en');
            $table->string('timezone')->default('UTC');
            
            // Metadata
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            
            $table->timestamps();
        });

        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->enum('admin_level', ['super_admin', 'admin', 'moderator'])->default('admin');
            $table->text('permissions')->nullable(); // JSON array of permissions
            
            $table->string('department')->nullable();
            $table->string('job_title')->nullable();
            
            $table->timestamp('created_by_id')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            $table->index('admin_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('admin_profiles');
    }
};
