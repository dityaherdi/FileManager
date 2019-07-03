<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_unit');
            $table->boolean('isFile')->default(1);
            $table->string('nama_asli');
            $table->string('nama_trash');
            $table->text('latest_path');
            $table->text('trash_path');
            $table->date('expired_date');
            $table->boolean('isTrashRemovedPermanently')->default(0);
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
        Schema::dropIfExists('trashes');
    }
}
