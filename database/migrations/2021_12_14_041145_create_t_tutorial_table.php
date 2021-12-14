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
            $table->string('code', 5);
            $table->string('name', 100);
            $table->enum('type',['video','text']);
            $table->text('files');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_tt')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_tt')->references(['id'])->on('users');
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
            $table->dropForeign('created_by_tt');
            $table->dropForeign('updated_by_tt');
        });
        Schema::dropIfExists('t_tutorial');
    }
}
