<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinnedTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinned_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskID');
            $table->unsignedBigInteger('personID');
            $table->foreign('taskID')
                ->references('ID')->on('task')
                ->onDelete('cascade');
            $table->foreign('personID')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinned_tasks');
    }
}
