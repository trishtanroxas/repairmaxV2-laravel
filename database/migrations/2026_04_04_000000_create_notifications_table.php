<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('cascade');
            
            $table->string('title');
            $table->text('message');
            $table->string('type'); // appointment_confirmation, repair_update, admin_alert, etc.
            $table->string('related_model')->nullable(); // Repair, Appointment, User, etc.
            $table->unsignedBigInteger('related_id')->nullable(); // ID of the related record
            
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            
            $table->timestamps();
            
            $table->index(['user_id', 'is_read']);
            $table->index('created_at');
        });

        Schema::create('admin_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            
            $table->string('action'); // created, updated, deleted, viewed
            $table->string('model_type'); // User, Repair, Appointment, etc.
            $table->unsignedBigInteger('model_id');
            $table->text('changes')->nullable(); // JSON of what changed
            
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            
            $table->timestamps();
            
            $table->index(['admin_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('admin_activity_logs');
    }
};
