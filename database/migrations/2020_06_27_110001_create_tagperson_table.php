<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagperson', function (Blueprint $table) {
            $table->unsignedBigInteger('tagID');
            $table->unsignedBigInteger('personID');
            $table->timestamps();
            $table->foreign('personID')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('tagID')
                ->references('id')->on('tag')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagperson');
    }
}
