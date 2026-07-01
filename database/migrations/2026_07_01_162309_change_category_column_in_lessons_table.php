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
            Schema::table('lessons', function (Blueprint $table) {
                $table->dropColumn('category'); // លុបអក្សរចាស់ចេញ
                // បង្កើត Foreign Key ភ្ជាប់ទៅតារាង categories
                $table->foreignId('category_id')->nullable()->after('title')->constrained()->onDelete('set null');
            });
        }

        public function down(): void
        {
            Schema::table('lessons', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
                $table->string('category')->default('General')->after('title');
            });
        }
};
