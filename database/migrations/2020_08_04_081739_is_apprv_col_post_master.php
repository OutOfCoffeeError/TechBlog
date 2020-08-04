<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IsApprvColPostMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_master', function (Blueprint $table) {
            $table->integer('is_approved')->nullable(false);
            // $table->string('imglink');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_master', function($table) {
            $table->dropColumn('is_approved');
        });
    }
}
