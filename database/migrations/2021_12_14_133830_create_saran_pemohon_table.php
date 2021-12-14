<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaranPemohonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saran_pemohon', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_saranId');
            $table->unsignedBigInteger('m_departementId');
            $table->text('content');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_sy')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_sy')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saran_pemohon', function (Blueprint $table) {
            $table->dropForeign('created_by_sy');
            $table->dropForeign('updated_by_sy');
        });
        Schema::dropIfExists('saran_pemohon');
    }
}
