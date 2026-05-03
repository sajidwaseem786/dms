<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteer_registrations', function (Blueprint $table) {
            $table->boolean('is_coordinator')->default(false)->after('status');
            $table->enum('attendance', ['present', 'absent', 'none'])->default('none')->after('is_coordinator');
        });
    }

    public function down(): void
    {
        Schema::table('volunteer_registrations', function (Blueprint $table) {
            $table->dropColumn(['is_coordinator', 'attendance']);
        });
    }
};