<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_homepage', function (Blueprint $table) {
            $table->string('id')->uniqid();
            $table->integer('type')->default(0);//1 banner,2 新闻，3 品牌，4 产品
            $table->string('ids')->nullable();//关联id，默认为空，banner为空，其他则存放id
            $table->string('cover')->nullable();//banner图，默认为空
            $table->string('url')->nullable();//默认为空，跳转链接
            $table->integer('is_hidden')->default(0);//默认0 不隐藏，1隐藏
            $table->integer('order')->default(0);//排序
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
        Schema::table('tb_homepage', function (Blueprint $table) {
            //
        });
    }
}
