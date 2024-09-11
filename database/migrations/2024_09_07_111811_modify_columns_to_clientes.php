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
        Schema::table('clientes', function (Blueprint $table) {
            //change column apellido to nullable
            $table->string('apellido')->nullable()->change();
            //change column email to nullable
            $table->string('email')->nullable()->change();
            //change column localidad to nullable
            $table->string('localidad')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('apellido')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('localidad')->nullable(false)->change();
        });
    }
};
