<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_layanan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departementId');
            $table->unsignedBigInteger('m_layananId');
            $table->unsignedBigInteger('m_pemohonId');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tl')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_tl')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_layanan', function (Blueprint $table) {
            $table->dropForeign('created_by_tl');
            $table->dropForeign('updated_by_tl');
        });
        Schema::dropIfExists('t_layanan');
    }
}
