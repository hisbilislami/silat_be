<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMEmployeeOccupationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_employee_occupation', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departement_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('m_occupation_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_eo')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_eo')->references(['id'])->on('users');
            $table->foreign(['m_departement_id'], 'm_departement_id_eo')->references(['id'])->on('m_departement');
            $table->foreign(['user_id'], 'user_id_eo')->references(['id'])->on('users');
            $table->foreign(['m_occupation_id'], 'm_occupation_id_eo')->references(['id'])->on('m_occupation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_employee_occupation', function (Blueprint $table) {
            $table->dropForeign('created_by_eo');
            $table->dropForeign('updated_by_eo');
            $table->dropForeign('m_departement_id_eo');
            $table->dropForeign('user_id_eo');
            $table->dropForeign('m_occupation_id_eo');
        });
        Schema::dropIfExists('m_employee_occupation');
    }
}
