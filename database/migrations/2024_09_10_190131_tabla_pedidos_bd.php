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
        Schema::create('Pedido', function (Blueprint $table) {
            $table->id();
            $table->date("Fecha");
            $table->unsignedBigInteger("orden_id"); // Cambiando el nombre de la columna a singular y cambiando el tipo a unsignedBigInteger
            $table->unsignedBigInteger("usuario_id"); // Cambiando el nombre de la columna a singular y cambiando el tipo a unsignedBigInteger
            $table->foreign("usuario_id")->references("id")->on("users")->onDelete("cascade"); // Definiendo la clave foránea y estableciendo la acción en cascada para eliminar
            $table->string('estado');
            $table->double('total', 9,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pedido');
    }
};
