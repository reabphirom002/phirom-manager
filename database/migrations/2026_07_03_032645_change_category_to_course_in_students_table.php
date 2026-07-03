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
    Schema::table('students', function (Blueprint $table) {
        // លុបការភ្ជាប់ជាមួយ Category ចាស់
        if (Schema::hasColumn('students', 'category_id')) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        }
        // បង្កើត Foreign Key ថ្មីភ្ជាប់ទៅកាន់តារាង courses វិញ
        $table->foreignId('course_id')->nullable()->after('email')->constrained()->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::table('students', function (Blueprint $table) {
                $table->dropForeign(['course_id']);
                $table->dropColumn('course_id');
                $table->foreignId('category_id')->nullable()->after('email')->constrained()->onDelete('set null');
            });
        }
};
