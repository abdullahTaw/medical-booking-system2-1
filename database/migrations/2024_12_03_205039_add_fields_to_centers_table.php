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
            $table->string('center_logo')->nullable()->after('id'); // شعار المركز
            $table->string('footer_logo')->nullable()->after('center_logo'); // شعار الفوتر
            $table->string('email')->nullable()->after('footer_logo'); // اسم المركز بالعربي
            $table->string('center_name')->nullable()->after('email'); // اسم المركز بالعربي
            $table->string('center_name_en')->nullable()->after('center_name');
            $table->string('center_address')->nullable()->after('center_name_en');
            $table->string('timezone')->nullable()->after('center_address');
            $table->string('facebook_url')->nullable()->after('timezone');
            $table->string('twitter_url')->nullable()->after('facebook_url');
            $table->string('instagram_url')->nullable()->after('twitter_url');
            $table->string('linkedin_url')->nullable()->after('instagram_url');
            $table->string('youtube_url')->nullable()->after('linkedin_url');
            $table->foreignId('currency_id')->constrained('currencies')->after('youtube_url'); // معرف العملة
            $table->boolean('maintenance_mode')->default(false)->after('currency_id'); // وضع الصيانة
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centers', function (Blueprint $table) {
            $table->dropColumn(['center_logo', 'footer_logo', 'center_name', 'center_name_en', 'maintenance_mode'
            , 'youtube_url'
            , 'linkedin_url'
            , 'instagram_url'
            , 'twitter_url'
            , 'facebook_url'
            , 'timezone'
            , 'center_address'
            , 'email' ]);
            $table->dropForeign(['currency_id']);
            $table->dropColumn('currency_id');        });
    }
};
