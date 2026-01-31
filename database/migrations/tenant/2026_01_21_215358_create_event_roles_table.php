<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('volunteer_roles')->onDelete('cascade');
            $table->json('volunteer_type_ids')->nullable();
            $table->integer('required_count')->default(1);
            $table->enum('compensation_type', ['none', 'fixed', 'hourly'])->default('none');
            $table->decimal('compensation_amount', 10, 2)->nullable();
            $table->timestamps();

            $table->index('event_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_roles');
    }
};
