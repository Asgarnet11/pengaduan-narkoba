<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'masyarakat'])->default('masyarakat')->after('password');
            $table->string('nik', 16)->unique()->after('role');
            $table->string('telp', 15)->after('nik');
            $table->string('foto')->nullable()->after('telp');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nik', 'telp', 'foto']);
        });
    }
};
