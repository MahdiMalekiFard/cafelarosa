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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('slug')->unique()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('published')->default(BooleanEnum::DISABLE->value);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->unsignedBigInteger('total_view')->default(0);
            $table->unsignedBigInteger('total_comment')->default(0);
            $table->unsignedBigInteger('total_like')->default(0);
            $table->text('languages')->nullable(); // ['fa', 'en']
            $table->schemalessAttributes('extra_attributes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
