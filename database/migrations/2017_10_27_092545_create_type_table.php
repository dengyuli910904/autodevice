<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('level')->default(0);
            $table->string('tree')->default('');

            $table->integer('code')->nullable();//类型编码
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
        Schema::table('tb_type', function (Blueprint $table) {
            //
        });
    }
}
