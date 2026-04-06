<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('last_name');
            $table->date('birth_date')->nullable()->after('gender');
            $table->string('street')->nullable()->after('birth_date');
            $table->string('house_number')->nullable()->after('street');
            $table->string('postal_code')->nullable()->after('house_number');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('country')->default('Nederland')->after('city');
            $table->string('phone')->nullable()->after('country');
            $table->string('iban')->nullable()->after('phone');
            $table->text('smoelenboek_description')->nullable()->after('iban');
            $table->string('big_ehbo')->nullable()->after('smoelenboek_description');
            $table->date('big_ehbo_valid_until')->nullable()->after('big_ehbo');
            $table->boolean('has_license')->default(false)->after('big_ehbo_valid_until');
            $table->string('profile_photo')->nullable()->after('has_license');
            $table->enum('status', ['active', 'inactive', 'conditional'])->default('active')->after('profile_photo');
            $table->boolean('is_admin')->default(false)->after('status');
            $table->timestamp('last_login_at')->nullable()->after('is_admin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'gender', 'birth_date',
                'street', 'house_number', 'postal_code', 'city', 'country',
                'phone', 'iban', 'smoelenboek_description',
                'big_ehbo', 'big_ehbo_valid_until', 'has_license',
                'profile_photo', 'status', 'is_admin', 'last_login_at',
            ]);
        });
    }
};