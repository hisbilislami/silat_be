<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPeraturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peraturan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100);
            $table->text('files');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tp')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_tp')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_peraturan', function (Blueprint $table) {
            $table->dropForeign('created_by_tp');
            $table->dropForeign('updated_by_tp');
        });
        Schema::dropIfExists('t_peraturan');
    }
}
