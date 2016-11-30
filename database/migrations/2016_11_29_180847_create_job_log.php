<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_log', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type' ,64)->nullable();
            $table->string('job_name')->nullable();
            $table->integer('group_num')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('place_id')->nullable();
            $table->string('place_name')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('section_name')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('num_received')->nullable();
            $table->integer('num_added')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->dateTime('failed_1')->nullable();
            $table->dateTime('failed_2')->nullable();
            $table->dateTime('failed_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('error_log', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type' ,64)->nullable();
            $table->string('job_name')->nullable();
            $table->integer('group_num')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('place_id')->nullable();
            $table->string('place_name')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('section_name')->nullable();
            $table->integer('post_id')->nullable();
            $table->string('error_message')->nullable();
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
        Schema::dropIfExists('error_log');
        Schema::dropIfExists('job_log');
    }
}
