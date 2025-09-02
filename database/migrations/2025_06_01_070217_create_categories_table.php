<?php

use App\Enums\BooleanEnum;
use App\Enums\CategoryTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('slug')->unique()->index();
            $table->foreignId('parent_id')->nullable()->constrained('categories');
            $table->string('type')->default(CategoryTypeEnum::BLOG->value);
            $table->boolean('published')->default(BooleanEnum::ENABLE->value);

            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->text('languages')->nullable(); // ['fa', 'en']
            $table->timestamps();
        });

        Schema::create('categoryables', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->morphs('categoryable');
            $table->unique(['category_id', 'categoryable_id', 'categoryable_type'], 'category_id_morph_id_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('categoryables');
    }
};
