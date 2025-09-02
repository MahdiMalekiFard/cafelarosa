<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('key');          // Unique key for the content (e.g., 'about_company')
            $table->string('title');
            $table->text('value');          // The actual content (e.g., "About our company...")
            $table->string('locale');       // Locale (e.g., 'en', 'fa', 'es')

            $table->unique(['key', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_contents');
    }
};
