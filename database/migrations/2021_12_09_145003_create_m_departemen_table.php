<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDepartemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_departement', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('code', 5);
            $table->string('name', 100);
            $table->string('letter_code', 100);
            $table->string('letter_type', 100);
            $table->string('icon', 255);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign(['created_by'], 'created_by_fk')->references(['id'])->on('users');
            $table->foreign(['updated_by'], 'updated_by_fk')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_departement', function (Blueprint $table) {
            $table->dropForeign('created_by_fk');
            $table->dropForeign('updated_by_fk');
        });
        Schema::dropIfExists('m_departement');
    }
}
