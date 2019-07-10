<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMetaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_meta_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_unit')->unsigned();
            $table->string('nama_file');
            $table->bigInteger('size')->unisgned();
            $table->string('extensi');
            $table->string('path');
            $table->boolean('isPrivate')->default(1);
            $table->boolean('isParentPrivate')->default(0);
            $table->boolean('status')->default(1);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_unit')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_meta_data');
    }
}
