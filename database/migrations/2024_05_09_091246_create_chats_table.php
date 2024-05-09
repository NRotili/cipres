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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            //Client_id nullable
            $table->unsignedBigInteger('client_id')->nullable();

            $table->foreign('client_id')->references('id')->on('clientes')->onDelete('set null');

            $table->text('tipo');  //Revendedor, Cons. Final, etc
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
