<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('personName');
            $table->unsignedBigInteger('taskID');
            $table->string('description')->nullable();
            $table->float('timeSpent')->default(0);
            $table->string('workDate')->nullable();
            $table->timestamps();

            $table->foreign('taskID')
                ->references('id')->on('task')
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
        Schema::dropIfExists('times');
    }
}
