<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_service', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('code', 5);
            $table->string('name', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_l')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_l')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_service', function (Blueprint $table) {
            $table->dropForeign('created_by_l');
            $table->dropForeign('updated_by_l');
        });
        Schema::dropIfExists('m_service');
    }
}
