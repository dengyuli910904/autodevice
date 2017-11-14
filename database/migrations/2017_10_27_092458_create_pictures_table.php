<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pictures', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('path');
            $table->integer('is_hidden')->default(0);//默认0 不隐藏，1隐藏
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
        Schema::table('tb_pictures', function (Blueprint $table) {
            //
        });
    }
}
