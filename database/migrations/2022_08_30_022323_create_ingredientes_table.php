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
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('stock');
            $table->string('nombre');
            $table->string('fecha_vencimiento');
        });


        Schema::create('Solicitud_chef', function(Blueprint $table)){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chef_id')->nullable();
            $table->foreign('chef_id')->references('id')->on('Chef')->onDelete('cascade');
            $table->unsignedBigInteger('ingredientes_id')->nullable();
            $table->foreign('ingredientes_id')->references('id')->on('Ingrediente')->onDelete('cascade');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('Solicitud_chef');
        Schema::dropIfExists('ingredientes');
    }
};

