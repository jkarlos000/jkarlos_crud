<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);//->unique(); //Tomar en cuenta que no se repita el mismo libro en una libreria
            $table->string('author', 100);
            $table->integer('pages')->unsigned();
            $table->unsignedBigInteger('libreria_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('libreria_id')->references('id')->on('librerias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
