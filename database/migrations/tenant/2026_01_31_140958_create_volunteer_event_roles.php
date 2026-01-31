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
        Schema::create('volunteer_event_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_role_id')->constrained('event_roles')->onDelete('cascade');
            $table->foreignId('volunteer_registration_id')->constrained('volunteer_registrations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_event_roles');
    }
};
