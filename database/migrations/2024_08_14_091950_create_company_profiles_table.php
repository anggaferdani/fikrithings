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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle');
            $table->string('image_banner_left');
            $table->string('image_banner_right');
            $table->string('image');
            $table->string('name');
            $table->text('description');
            $table->text('instagram')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('tiktok')->nullable();
            $table->text('facebook')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
