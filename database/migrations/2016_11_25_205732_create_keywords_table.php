<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tech_name' ,64)->unique();
            $table->string('tech_type')->nullable();
            $table->string('tech_text_1')->nullable();
            $table->string('tech_text_2')->nullable();
            $table->string('tech_text_3')->nullable();
            $table->string('tech_text_4')->nullable();
            $table->string('tech_text_5')->nullable();
            $table->float('seq_no');
            $table->string('status',16);
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
        Schema::dropIfExists('keywords');
        
    }
}
