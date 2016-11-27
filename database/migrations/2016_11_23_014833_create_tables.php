<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name' ,64)->unique();
            $table->string('view_name');
            $table->string('status',16);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sections', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name' ,64)->unique();
            $table->string('description');
            $table->string('url');
            $table->string('status',16);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('places', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name' ,64)->unique();
            $table->string('url', 1024);
            $table->string('status',16);
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('posts', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')->references('id')->on('places');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('post_id' ,64)->nullable();
            $table->dateTime('post_date')->nullable();
            $table->string('heading', 1024)->nullable();
            $table->string('description', 4096)->nullable();
            $table->string('job_link', 1024)->nullable();
            $table->boolean('ignore_flg')->nullable();
            $table->string('email_addr', 1024)->nullable();
            $table->integer('email_id')->unsigned()->nullable();
            $table->foreign('email_id')->references('id')->on('emails');
            $table->boolean('resp_received')->nullable();
            $table->string('bad_action', 16)->nullable();
            $table->string('status',16)->nullable();
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('places');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('emails');
    }
}
