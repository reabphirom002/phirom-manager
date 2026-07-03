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
        // បន្ថែម Foreign Key ភ្ជាប់ទៅកាន់តារាង classrooms ថ្មី
        $table->foreignId('classroom_id')->nullable()->after('course_id')->constrained()->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropForeign(['classroom_id']);
        $table->dropColumn('classroom_id');
    });
}
};
