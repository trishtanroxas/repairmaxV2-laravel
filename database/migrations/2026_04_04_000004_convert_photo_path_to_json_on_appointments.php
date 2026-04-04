<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Rename the column if it exists as photo_path
        if (Schema::hasColumn('appointments', 'photo_path')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->renameColumn('photo_path', 'photo_paths');
            });
        }

        // 2. Ensure the column exists and is TEXT temporarily to avoid JSON validation errors
        if (!Schema::hasColumn('appointments', 'photo_paths')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->text('photo_paths')->nullable()->after('description');
            });
        } else {
            Schema::table('appointments', function (Blueprint $table) {
                $table->text('photo_paths')->nullable()->change();
            });
        }

        // 3. Convert existing string paths to JSON arrays
        // e.g. "path/to/img.jpg" becomes "[\"path/to/img.jpg\"]"
        // But only if it doesn't already look like JSON
        DB::table('appointments')
            ->whereNotNull('photo_paths')
            ->where('photo_paths', 'not like', '[%')
            ->get()
            ->each(function ($appointment) {
                DB::table('appointments')
                    ->where('id', $appointment->id)
                    ->update(['photo_paths' => json_encode([$appointment->photo_paths])]);
            });

        // 4. Finally, change the column to JSON
        Schema::table('appointments', function (Blueprint $table) {
            $table->json('photo_paths')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('photo_paths', 'photo_path');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->change();
        });
    }
};
