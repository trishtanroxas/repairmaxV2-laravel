<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('barangay')->nullable()->after('address');
            $table->string('alt_address')->nullable()->after('city');
            $table->string('alt_barangay')->nullable()->after('alt_address');
            $table->string('alt_city')->nullable()->after('alt_barangay');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('barangay')->nullable()->after('address');
            $table->string('alt_address')->nullable()->after('city');
            $table->string('alt_barangay')->nullable()->after('alt_address');
            $table->string('alt_city')->nullable()->after('alt_barangay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['barangay', 'alt_address', 'alt_barangay', 'alt_city']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['barangay', 'alt_address', 'alt_barangay', 'alt_city']);
        });
    }
};
