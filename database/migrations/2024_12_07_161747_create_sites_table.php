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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id')->index();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('site_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('title1')->nullable();
            $table->text('title2')->nullable();
            $table->text('title3')->nullable();
            $table->text('text1')->nullable();
            $table->text('text2')->nullable();
            $table->text('text21')->nullable();
            $table->text('text3')->nullable();
            $table->integer('num1')->nullable();
            $table->integer('num2')->nullable();
            $table->string('image')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
