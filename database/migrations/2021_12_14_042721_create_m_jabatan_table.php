<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_jabatan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_departementId');
            $table->unsignedBigInteger('m_userId');
            $table->string('jabatan', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_mj')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_mj')->references(['id'])->on('m_user');
            // $table->foreign(['m_departementId'], 'm_departementId_mj')->references(['id'])->on('m_departement');
            // $table->foreign(['m_userId'], 'm_userId_mj')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_jabatan', function (Blueprint $table) {
            $table->dropForeign('created_by_mj');
            $table->dropForeign('updated_by_mj');
            // $table->dropForeign('m_departementId_mj');
            // $table->dropForeign('m_userId_mj');
        });
        Schema::dropIfExists('m_jabatan');
    }
}
