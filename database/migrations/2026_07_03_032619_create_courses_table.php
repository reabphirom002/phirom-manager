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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ឈ្មោះវគ្គសិក្សា (ឧទាហរណ៍៖ Full Stack Web Development)
            $table->decimal('fee', 8, 2)->default(0.00); // តម្លៃសិក្សា (តម្លៃ $120.00)
            $table->string('duration')->nullable(); // រយៈពេលសិក្សា (ឧទាហរណ៍៖ ៣ ខែ)
            $table->text('description')->nullable(); // ការពិពណ៌នាសង្ខេប
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
