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
        Schema::create('bebidas', function (Blueprint $table) {
            $table->id();
            $table->string('grado_alcoholico');
            $table->foreignId('producto_id')
            ->constrained('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bebidas');
    }
};
