<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunningTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_running_text', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_r')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_r')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_running_text', function (Blueprint $table) {
            $table->dropForeign('created_by_r');
            $table->dropForeign('updated_by_r');
        });
        Schema::dropIfExists('t_running_text');
    }
}
