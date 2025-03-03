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
        Schema::create('Orden', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("producto_id"); // Cambiando el nombre de la columna a singular y cambiando el tipo a unsignedBigInteger
            $table->foreign("producto_id")->references("id")->on("producto")->onDelete("cascade"); // Definiendo la clave foránea y estableciendo la acción en cascada para eliminar
            $table->integer('cantidad');
            $table->double('precio');
            $table->integer('no_pedido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Orden');
    }
};
