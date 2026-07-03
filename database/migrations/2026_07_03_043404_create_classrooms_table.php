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
    Schema::create('classrooms', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // ឈ្មោះថ្នាក់រៀន (ឧទាហរណ៍៖ Class Web-A1)
        $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null'); // វគ្គសិក្សា
        $table->string('teacher_name'); // ឈ្មោះគ្រូបង្រៀន
        $table->string('room')->nullable(); // បន្ទប់រៀន (ឧទាហរណ៍៖ Lab 1)
        $table->string('days'); // ថ្ងៃសិក្សា (ឧទាហរណ៍៖ ចន្ទ-ពុធ-សុក្រ)
        $table->string('time_slot'); // ម៉ោងសិក្សា (ឧទាហរណ៍៖ 08:00 AM - 09:30 AM)
        $table->string('status')->default('active'); // active (កំពុងដំណើរការ), completed (បញ្ចប់)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
