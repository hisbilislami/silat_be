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
        Schema::create('m_departement_service', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departement_id');
            $table->unsignedBigInteger('m_service_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_ml')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_ml')->references(['id'])->on('users');
            $table->foreign(['m_departement_id'], 'm_departement_id_ml')->references(['id'])->on('m_departement');
            $table->foreign(['m_service_id'], 'm_service_id_ml')->references(['id'])->on('m_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_departement_service', function (Blueprint $table) {
            $table->dropForeign('created_by_ml');
            $table->dropForeign('updated_by_ml');
            $table->dropForeign('m_departement_id_ml');
            $table->dropForeign('m_service_id_ml');
        });
        Schema::dropIfExists('m_departement_service');
    }
}
