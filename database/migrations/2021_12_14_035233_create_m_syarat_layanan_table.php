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
        Schema::create('m_syarat_layanan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('m_layananId');
            $table->unsignedBigInteger('m_syaratId');
            $table->enum('type', ['text', 'file']);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_sl')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_sl')->references(['id'])->on('m_user');
            // $table->foreign(['m_layananId'], 'm_layananId_sl')->references(['id'])->on('m_layanan');
            // $table->foreign(['m_syaratId'], 'm_syaratId_sl')->references(['id'])->on('m_syarat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_syarat_layanan', function (Blueprint $table) {
            $table->dropForeign('created_by_sl');
            $table->dropForeign('updated_by_sl');
            // $table->dropForeign('m_layananId_sl');
            // $table->dropForeign('m_syaratId_sl');
        });
        Schema::dropIfExists('m_syarat_layanan');
    }
}
