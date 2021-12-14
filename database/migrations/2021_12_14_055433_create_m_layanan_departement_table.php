<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLayananDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_layanan_departement', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departementId');
            $table->unsignedBigInteger('m_layananId');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_ml')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_ml')->references(['id'])->on('m_user');
            // $table->foreign(['m_departementId'], 'm_departementId_ml')->references(['id'])->on('m_user');
            // $table->foreign(['m_layananId'], 'm_layananId_ml')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_layanan_departement', function (Blueprint $table) {
            $table->dropForeign('created_by_ml');
            $table->dropForeign('updated_by_ml');
            // $table->dropForeign('m_departementId_ml');
            // $table->dropForeign('m_layananId_ml');
        });
        Schema::dropIfExists('m_layanan_departement');
    }
}
