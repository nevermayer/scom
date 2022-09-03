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
        Schema::create('ingrediente_postre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postres_id')
            ->constrained('postres');
            $table->foreignId('ingredientes_id')
            ->constrained('ingredientes');
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
        Schema::dropIfExists('ingrediente_postre');
    }
};
