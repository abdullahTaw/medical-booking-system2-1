<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('centers', function (Blueprint $table) {
            // رقم الترخيص — فريد لكل عيادة
            $table->string('license_number')->unique()->nullable()->after('phone');
            // ملف الترخيص الحكومي (PDF أو صورة)
            $table->string('license_file')->nullable()->after('license_number');
            // حالة التوثيق: pending / approved / rejected
            $table->enum('license_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')->after('license_file');
        });
    }

    public function down(): void
    {
        Schema::table('centers', function (Blueprint $table) {
            $table->dropColumn(['license_number', 'license_file', 'license_status']);
        });
    }
};
