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
        Schema::create('m_occupation', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('code', 5);
            $table->string('name', 100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_mj')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_mj')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_occupation', function (Blueprint $table) {
            $table->dropForeign('created_by_mj');
            $table->dropForeign('updated_by_mj');
        });
        Schema::dropIfExists('m_occupation');
    }
}
