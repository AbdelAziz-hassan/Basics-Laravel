<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_title', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keyword_id')->unsigned();
            $table->integer('title_id')->unsigned();
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword_title');
    }
}
