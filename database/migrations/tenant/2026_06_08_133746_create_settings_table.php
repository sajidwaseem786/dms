<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('variable')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        $defaults = [
            'planningcat' => json_encode([
                ['Sportevenement', 'Sportevenement'],
                ['kids', 'Kinderen'],
                ['Dancefestival', 'Dance / Festival'],
                ['Cultureel evenement', 'Cultureel evenement'],
                ['training', 'Training'],
                ['overige', 'Overige'],
            ]),
            'reminder_signature'    => "Met vriendelijke groet,\nHet planningsteam van stichting Dutch Medical Service",
            'email_signature'       => 'Met vriendelijke groet, Het planningsteam van stichting Dutch Medical Service',
            'reminder_text_verder'  => '',
            'notification_email'    => 'h.jobsen@dutchmedicalservice.nl',
            'reminder_general'      => '',
        ];

        $now = now();

        foreach ($defaults as $variable => $value) {
            DB::table('settings')->updateOrInsert(
                ['variable' => $variable],
                ['value' => $value, 'created_at' => $now, 'updated_at' => $now],
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};