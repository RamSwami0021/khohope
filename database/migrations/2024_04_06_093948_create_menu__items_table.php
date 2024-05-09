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
        Schema::create('menu__items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categorie_id');
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('image_url')->nullable();
            $table->string('status')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('menu__categories');
            $table->foreign('user_id')->references('id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu__items');
    }
};
