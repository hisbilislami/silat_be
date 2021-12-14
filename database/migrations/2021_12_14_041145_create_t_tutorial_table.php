<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTutorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tutorial', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100);
            $table->enum('type',['video','text']);
            $table->text('files');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tt')->references(['id'])->on('m_user');
            $table->foreign(['updated_by'], 'updated_by_tt')->references(['id'])->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_tutorial', function (Blueprint $table) {
            $table->dropForeign('created_by_tp');
            $table->dropForeign('updated_by_tp');
        });
        Schema::dropIfExists('t_tutorial');
    }
}
