<?php

use App\Enums\BooleanEnum;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->timestamp('mobile_verify_at')->nullable();
            $table->timestamp('email_verify_at')->nullable();
            $table->string('fcm_token')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('google_id')->nullable();
            $table->schemalessAttributes('extra_attributes');
            $table->boolean('enable_notification')->default(BooleanEnum::DISABLE->value);
            $table->boolean('enable_subscription')->default(BooleanEnum::DISABLE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
