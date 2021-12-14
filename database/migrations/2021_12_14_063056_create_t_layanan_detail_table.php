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
        Schema::create('t_layanan_detail', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('t_layananId');
            $table->unsignedBigInteger('m_userId');
            $table->string('tahap', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_ld')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_ld')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_layanan_detail', function (Blueprint $table) {
            $table->dropForeign('created_by_ld');
            $table->dropForeign('updated_by_ld');
        });
        Schema::dropIfExists('t_layanan_detail');
    }
}
