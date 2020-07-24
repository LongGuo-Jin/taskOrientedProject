<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTaskTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_task_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskID');
            $table->float('timeSpentOnSubTask')->default(0);
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
        Schema::dropIfExists('sub_task_times');
    }
}
