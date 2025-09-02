<?php

use App\Enums\ArtGalleryTypeEnum;
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
        Schema::create('art_galleries', function (Blueprint $table) {
            $table->id();
            // translations : title, description
            $table->text('languages')->nullable(); // ['da', 'en']
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art_galleries');
    }
};
