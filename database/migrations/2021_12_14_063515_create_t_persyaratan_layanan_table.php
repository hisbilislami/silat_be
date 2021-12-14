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
        Schema::create('t_persyaratan_layanan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('t_layananId');
            $table->unsignedBigInteger('m_syaratId');
            $table->text('file');
            $table->enum('status', ['Y', 'T']);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tpe')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_tpe')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_persyaratan_layanan', function (Blueprint $table) {
            $table->dropForeign('created_by_tpe');
            $table->dropForeign('updated_by_tpe');
        });
        Schema::dropIfExists('t_persyaratan_layanan');
    }
}
