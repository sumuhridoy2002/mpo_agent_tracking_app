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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->after('password');
            $table->boolean('phone_verified')->after('phone')->default(0);
            $table->string('designation')->after('phone_verified')->nullable();
            $table->string('avatar')->after('designation')->nullable();
            $table->string('certification')->after('avatar')->nullable();
            $table->string('nid')->after('certification')->nullable();
            $table->string('nid_pdf')->after('nid')->nullable();
            $table->string('passport')->after('nid_pdf')->nullable();
            $table->string('passport_pdf')->after('passport')->nullable();
            $table->string('address')->after('passport_pdf')->nullable();
            $table->enum('role', ['Super Admin', 'Admin', 'Agent'])->after('address')->default('Agent');
            $table->enum('account_status', ['Active', 'Inactive', 'Banned'])->after('role')->default('Inactive');
            $table->boolean('is_profile_completed')->after('account_status')->default(0);
            $table->string('otp')->after('is_profile_completed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
