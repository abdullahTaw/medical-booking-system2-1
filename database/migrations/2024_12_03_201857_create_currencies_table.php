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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // رمز العملة مثل USD
            $table->string('name'); // اسم العملة مثل Dollar
            $table->string('symbol')->nullable(); // رمز العملة مثل $
            $table->float('exchange_rate', 8, 4)->default(1.0); // سعر الصرف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
