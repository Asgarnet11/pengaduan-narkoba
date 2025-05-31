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
        // Hapus foreign key constraint yang ada
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['user_id']);
        });

        // Ubah kolom admin_id dan user_id menjadi nullable
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
        });

        // Tambahkan kembali foreign key constraint
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key constraint
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['user_id']);
        });

        // Ubah kembali kolom admin_id menjadi required
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable(false)->change();
            $table->foreignId('user_id')->nullable(false)->change();
        });

        // Tambahkan kembali foreign key constraint
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
