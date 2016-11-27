<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeywordsIdGroupNum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function ($table) {
            $table->integer('group_num')->after('email_url');
        });

        Schema::table('posts', function ($table) {
            $table->integer('keyword_id')->unsigned()->nullable()->after('email_sent_at');
            $table->foreign('keyword_id')->references('id')->on('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function ($table) {
            $table->dropColumn('group_num');
        });

        Schema::table('posts', function ($table) {
            $table->dropForeign('posts_keyword_id_foreign');
            $table->dropColumn('keyword_id');
        });
    }
}
