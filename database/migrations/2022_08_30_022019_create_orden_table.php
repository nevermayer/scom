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
        Schema::create('orden', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_pat');
            $table->double('total');
            $table->string('estado');
            $table->date('fecha');
            $table->dateTime('hora');
            $table->integer('telefono');
            $table->foreignId('chef_id')
                ->nullable()
                ->constrained('chef')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('camarero_id')
                ->nullable()
                ->constrained('camarero')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden');
    }
};
