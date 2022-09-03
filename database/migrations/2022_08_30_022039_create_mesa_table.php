<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void  

     */
    public function up()
    {
        Schema::create('mesa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('min_capacidad');
            $table->string('max_capacidad');
            $table->string('status');
            $table->foreignId('orden_id')
            ->constrained('orden');
            $table->foreignId('camarero_id')
            ->constrained('camarero');
            $table->foreignId('cliente_id')
            ->constrained('cliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesa');
    }
};
