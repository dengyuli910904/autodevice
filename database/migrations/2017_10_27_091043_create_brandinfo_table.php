<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_brand', function (Blueprint $table) {
            $table->string('id');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('name');
            $table->integer('is_hidden')->default(0);//是否隐藏，0 不隐藏，1隐藏
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
        Schema::table('tb_brand', function (Blueprint $table) {
            //
        });
    }
}
