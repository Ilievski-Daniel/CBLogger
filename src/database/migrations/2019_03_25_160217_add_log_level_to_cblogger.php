<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Monolog\Logger;

class AddLogLevelToCblogger extends Migration
{

    const DEFAULT_LOG_LEVEL = 250;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cblogger', function (Blueprint $table) {
            $table->integer('level_int')->default(self::DEFAULT_LOG_LEVEL);
            $table->string('level_string')->default(Logger::getLevelName(self::DEFAULT_LOG_LEVEL));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cblogger', function (Blueprint $table) {
            $table->integer('level_int');
            $table->integer('level_string');
        });
    }
}
