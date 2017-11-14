<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jobs', function (Blueprint $table) {
            $table->integer('id',true)->uniqid();
            $table->string('name');
            $table->string('address')->nullable();
            $table->integer('nature')->default(1);//工作性质，1全职，2兼职
            $table->integer('salary')->default(0);//月薪，0面议，其他范围
            $table->integer('education')->default(0);//学历，0 无要求，1高中，2大专，3本科
            $table->integer('is_manager')->default(0);//是否要求管理经验，0不要求，1要求
            $table->integer('limit')->default(0);//招聘人数，0为若干，其他为数字
            $table->integer('experience')->default(0);//经验要求，0 不要求，其他为年限范围
            $table->text('content')->nullable();//招聘内容
            $table->integer('is_hidden')->default(0);//是否发布，0发布，2不发布
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
        Schema::table('tb_jobs', function (Blueprint $table) {
            //
        });
    }
}
