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
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // ចំណងជើងមេរៀន
        $table->text('description')->nullable(); // ការពិពណ៌នាលម្អិត
        $table->string('type'); // ប្រភេទ៖ video, pdf, word, image
        $table->string('file_path')->nullable(); // ផ្លូវសម្រាប់ផ្ទុកឯកសារ PDF/Word/Image ក្នុង Server
        $table->string('youtube_url')->nullable(); // លីងវីដេអូពី YouTube
        $table->string('thumbnail')->nullable(); // រូបភាព Thumbnail តំណាងមេរៀន
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
