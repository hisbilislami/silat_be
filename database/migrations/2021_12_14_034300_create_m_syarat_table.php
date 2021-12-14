<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSyaratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_syarat', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_s')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_s')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_syarat', function (Blueprint $table) {
            $table->dropForeign('created_by_s');
            $table->dropForeign('updated_by_s');
        });
        Schema::dropIfExists('m_syarat');
    }
}
