<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskID');
            $table->unsignedBigInteger('tagID');
            $table->timestamps();
            $table->foreign('taskID')
                ->references('ID')->on('task')
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
        Schema::dropIfExists('tag_tasks');
    }
}
