<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // super_admin | admin | member
            $table->string('role')->default('member');
            // NULL for the SuperAdmin (belongs to no company). Plain indexed column so it also works
            // when altering an existing table on SQLite.
            $table->unsignedBigInteger('company_id')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropColumn(['role', 'company_id']);
        });
    }
};
