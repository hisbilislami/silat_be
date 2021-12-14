<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSyaratLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_service_prerequisite', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_service_id');
            $table->unsignedBigInteger('m_prerequisite_id');
            $table->enum('type', ['text', 'file']);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_sl')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_sl')->references(['id'])->on('users');
            $table->foreign(['m_service_id'], 'm_service_id_sl')->references(['id'])->on('m_service');
            $table->foreign(['m_prerequisite_id'], 'm_prerequisite_id_sl')->references(['id'])->on('m_prerequisite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_service_prerequisite', function (Blueprint $table) {
            $table->dropForeign('created_by_sl');
            $table->dropForeign('updated_by_sl');
            $table->dropForeign('m_service_id_sl');
            $table->dropForeign('m_prerequisite_id_sl');
        });
        Schema::dropIfExists('m_service_prerequisite');
    }
}
