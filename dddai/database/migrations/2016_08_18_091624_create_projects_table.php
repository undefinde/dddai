<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('pid');
            $table->integer('uid');
            $table->string('name', 10);
            $table->integer('money');
            $table->string('mobile', 11);
            $table->string('tittle', 50);
            $table->tinyinteger('rate');
            $table->tinyinteger('hrange');
            $table->tinyinteger('status');
            $table->integer('receive');
            $table->integer('pubtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
