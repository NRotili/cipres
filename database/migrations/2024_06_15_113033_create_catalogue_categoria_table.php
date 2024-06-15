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
        Schema::create('catalogue_categoria', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('catalogue_id');
            $table->unsignedBigInteger('categoria_id');

            $table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogue_categoria');
    }
};
