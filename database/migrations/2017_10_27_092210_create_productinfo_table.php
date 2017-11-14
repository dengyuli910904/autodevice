<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_product', function (Blueprint $table) {
            $table->string('id')->uniqid();
            $table->string('name')->uniqid();
            $table->text('intro')->nullable();
            $table->string('version');
            $table->text('description')->nullable();
            $table->text('parameters')->nullable();
            $table->integer('is_store')->default(0);//默认没有库存，1是有库存
            $table->integer('is_hidden')->default(0);//默认上架，1是隐藏
            $table->integer('is_sale')->default(0);//默认非特价，1是特价
            $table->integer('is_discounts')->default(0);//默认非折扣，1折扣
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
        Schema::table('tb_product', function (Blueprint $table) {
            //
        });
    }
}
