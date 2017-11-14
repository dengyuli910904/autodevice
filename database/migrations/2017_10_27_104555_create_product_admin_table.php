<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->integer('id',true)->uniqid();
            $table->string('name');
            $table->string('pwd');
            $table->string('solt')->nullable();
            $table->integer('is_able')->default(1);//若为0 则是禁用，1是启用
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_admin', function (Blueprint $table) {
            //
        });
    }
}
