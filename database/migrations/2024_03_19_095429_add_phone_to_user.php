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
            //
            $table->string('phone')->nullable()->after('email');
            $table->string('company')->nullable()->after('phone');
            $table->string('country')->nullable()->after('company');
            $table->string('address')->nullable()->after('country');
            $table->string('profile_picture')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone')->after('email')->nullable();
            $table->dropColumn('company')->after('phone')->nullable();
            $table->dropColumn('country')->after('company')->nullable();
            $table->dropColumn('address')->after('country')->nullable();
            $table->dropColumn('profile_picture')->after('address')->nullable();
        });
    }
};
