<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_brand_product', function (Blueprint $table) {
            $table->string('id')->uniqid();
            $table->string('brand_id');//品牌id
            $table->string('product_id');//产品id
            $table->integer('order')->default(0);//排序
            $table->integer('is_hiiden')->default(0);//是否显示，0 显示，1 不显示
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
        Schema::table('tb_brand_product', function (Blueprint $table) {
            //
        });
    }
}
