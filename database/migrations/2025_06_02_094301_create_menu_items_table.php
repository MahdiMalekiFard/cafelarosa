<?php

use App\Enums\BooleanEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            // translation: title, description
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->text('languages')->nullable(); // ['fa', 'en']
            $table->boolean('published')->default(BooleanEnum::DISABLE->value);
            $table->unsignedMediumInteger('normal_price');
            $table->unsignedMediumInteger('special_price');
            $table->schemalessAttributes('extra_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
