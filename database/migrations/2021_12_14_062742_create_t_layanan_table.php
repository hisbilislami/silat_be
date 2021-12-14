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
        Schema::create('t_service', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departement_id');
            $table->unsignedBigInteger('m_service_id');
            $table->unsignedBigInteger('m_applicant_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tl')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_tl')->references(['id'])->on('users');
            $table->foreign(['m_departement_id'], 'm_departement_id_tl')->references(['id'])->on('m_departement');
            $table->foreign(['m_service_id'], 'm_service_id_tl')->references(['id'])->on('m_service');
            $table->foreign(['m_applicant_id'], 'm_applicant_id_tl')->references(['id'])->on('m_applicant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_service', function (Blueprint $table) {
            $table->dropForeign('created_by_tl');
            $table->dropForeign('updated_by_tl');
            $table->dropForeign('m_departement_id_tl');
            $table->dropForeign('m_service_id_tl');
            $table->dropForeign('m_applicant_id_tl');
        });
        Schema::dropIfExists('t_service');
    }
}
