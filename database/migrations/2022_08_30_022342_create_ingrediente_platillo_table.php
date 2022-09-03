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
        Schema::create('ingrediente_platillo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platillo_id')
            ->constrained('platillo');
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
        Schema::dropIfExists('ingrediente_platillo');
    }
};
