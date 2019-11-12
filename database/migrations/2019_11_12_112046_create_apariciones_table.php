<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAparicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apariciones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('aparicion');
            $table->unsignedInteger('frecuencia_id'); 
            $table->timestamps();

            $table->foreign('frecuencia_id')->references('id')->on('frecuencias')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['frecuencia_id']); 
        Schema::dropIfExists('apariciones');
    }
}
