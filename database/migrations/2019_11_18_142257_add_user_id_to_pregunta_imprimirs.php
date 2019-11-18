<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPreguntaImprimirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('pregunta_imprimirs', function (Blueprint $table){
            $table->unsignedInteger('user_id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregunta_imprimirs', function (Blueprint $table){
            $table->dropColumn('user_id');    
        });
    }   
}
