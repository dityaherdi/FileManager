<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_unit')->unsigned();
            $table->string('nama_folder');
            $table->string('path');
            $table->boolean('root')->default(0);
            $table->boolean('isPrivate')->default(0);
            $table->boolean('isParentPrivate')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('id_unit')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
