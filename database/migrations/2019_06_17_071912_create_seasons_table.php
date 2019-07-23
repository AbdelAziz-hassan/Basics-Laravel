<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('picture')->nullable();
            $table->integer('duration'); //seconds
            $table->text('description')->nullable();
            $table->date('release_date');
            $table->decimal('rate', 2, 2)->default(0);            
            $table->integer('episodes_numbers');
            $table->integer('title_id')->unsigned();
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
        Schema::dropIfExists('seasons');
    }
}
