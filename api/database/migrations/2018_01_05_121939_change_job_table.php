<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('company');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->boolean('completed')->default(false);
            $table->integer('client_id')->unsigned()->nullable();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('name');
            $table->string('company');
            $table->string('email');
            $table->string('phone');
            $table->dropColumn('completed');
            $table->dropColumn('client_id');
        });
    }
}
