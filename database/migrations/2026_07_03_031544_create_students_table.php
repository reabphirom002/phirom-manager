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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // ឈ្មោះសិស្ស
        $table->string('phone')->nullable(); // លេខទូរស័ព្ទ
        $table->string('email')->nullable(); // អ៊ីមែល
        // ភ្ជាប់ Foreign Key ទៅកាន់តារាង categories (វគ្គសិក្សាដែលចូលរៀន)
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->string('status')->default('active'); // ស្ថានភាព៖ active (កំពុងរៀន), completed (រៀនចប់), dropped (បោះបង់)
        $table->date('enrollment_date'); // ថ្ងៃចូលរៀន
        $table->text('notes')->nullable(); // កំណត់ចំណាំផ្សេងៗ
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
