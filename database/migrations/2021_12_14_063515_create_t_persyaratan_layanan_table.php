<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPersyaratanLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_service_prerequisite', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('t_service_id');
            $table->unsignedBigInteger('m_prerequisite_id');
            $table->text('file');
            $table->enum('status', ['complete', 'incomplete'])->default('incomplete');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tpe')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_tpe')->references(['id'])->on('users');
            $table->foreign(['t_service_id'], 't_service_id_tpe')->references(['id'])->on('t_service');
            $table->foreign(['m_prerequisite_id'], 'm_prerequisite_id_tpe')->references(['id'])->on('m_prerequisite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_service_prerequisite', function (Blueprint $table) {
            $table->dropForeign('created_by_tpe');
            $table->dropForeign('updated_by_tpe');
            $table->dropForeign('t_service_id_tpe');
            $table->dropForeign('m_prerequisite_id_tpe');
        });
        Schema::dropIfExists('t_service_prerequisite');
    }
}
