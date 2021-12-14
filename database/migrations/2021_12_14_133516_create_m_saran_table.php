<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_suggestion', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('suggest', 100);
            $table->unsignedBigInteger('m_departement_id');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['updated_by'], 'updated_by_sa')->references(['id'])->on('users');
            $table->foreign(['m_departement_id'], 'm_departement_id_sa')->references(['id'])->on('m_departement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_suggestion', function (Blueprint $table) {
            $table->dropForeign('updated_by_sa');
            $table->dropForeign('m_departement_id_sa');
        });
        Schema::dropIfExists('t_suggestion');
    }
}
