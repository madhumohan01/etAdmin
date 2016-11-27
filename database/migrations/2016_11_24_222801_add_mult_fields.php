<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function ($table) {
            $table->string('time_zone',5)->after('email_url');
            $table->string('lang_string')->nullable()->after('email_url');
        });
        Schema::table('posts', function ($table) {
            $table->dateTime('email_sent_at')->nullable()->after('email_id');
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
            $table->dropColumn('time_zone');
            $table->dropColumn('lang_string');
        });
        Schema::table('posts', function ($table) {
            $table->dropColumn('email_sent_at');
        });
    
    }
}
