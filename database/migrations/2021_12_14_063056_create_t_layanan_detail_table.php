<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLayananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_service_detail', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('t_service_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('stage')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_ld')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_ld')->references(['id'])->on('users');
            $table->foreign(['t_service_id'], 't_service_id_ld')->references(['id'])->on('t_service');
            $table->foreign(['user_id'], 'user_id_ld')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_service_detail', function (Blueprint $table) {
            $table->dropForeign('created_by_ld');
            $table->dropForeign('updated_by_ld');

            $table->dropForeign('t_service_id_ld');
            $table->dropForeign('user_id_ld');
        });
        Schema::dropIfExists('t_service_detail');
    }
}
