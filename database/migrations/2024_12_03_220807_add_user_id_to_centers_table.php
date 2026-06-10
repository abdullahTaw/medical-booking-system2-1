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
        Schema::table('centers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // إضافة user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // علاقة خارجية
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centers', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // حذف المفتاح الخارجي
            $table->dropColumn('user_id'); // حذف العمود
        });
    }
};
