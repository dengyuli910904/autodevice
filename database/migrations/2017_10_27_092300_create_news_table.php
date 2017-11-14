<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_news', function (Blueprint $table) {
            $table->string('id')->uniqid();
            $table->string('title');
            $table->string('intro')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('publish_time')->nullable();
            $table->integer('read_count')->default(0);
            $table->integer('is_hidden')->default(0);
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
        Schema::table('tb_news', function (Blueprint $table) {
            //
        });
    }
}
