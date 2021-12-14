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
        Schema::create('m_saran', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_sa')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_sa')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_saran', function (Blueprint $table) {
            $table->dropForeign('created_by_sa');
            $table->dropForeign('updated_by_sa');
        });
        Schema::dropIfExists('m_saran');
    }
}
