<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('title')->nullable();
            $table->string('datePlanStart')->nullable();
            $table->string('datePlanEnd')->nullable();
            $table->string('dateActualStart')->nullable();
            $table->string('dateActualEnd')->nullable();
            $table->unsignedBigInteger('statusID');
            $table->unsignedBigInteger('priorityID');
            $table->unsignedBigInteger('weightID');
            $table->unsignedBigInteger('personID');
            $table->float('budgetAllocated')->nullable();
            $table->float('hoursAllocated')->nullable();
            $table->float('hourSpent')->nullable();
            $table->float('hourCost')->nullable();
//            $table->integer('organizationID')->unsigned();
//            $table->integer('locationID')->unsigned();
            $table->unsignedBigInteger('parentID');
            $table->string('tags')->nullable();
            $table->string('description')->nullable();
            $table->string('creatAt')->nullable();
            $table->string('updateAt')->nullable();
            $table->unsignedBigInteger('taskCreatorID');
            $table->integer('deleteFlag')->unsigned();
            $table->timestamps();
            $table->foreign('weightID')
                ->references('ID')->on('taskweight')
                ->onDelete('cascade');
//            $table->foreign('organizationID')
//                ->references('ID')->on('organization')
//                ->onDelete('cascade');
//            $table->foreign('locationID')
//                ->references('ID')->on('address')
//                ->onDelete('cascade');
            $table->foreign('parentID')
                ->references('ID')->on('task')
                ->onDelete('cascade');
            $table->foreign('statusID')
                ->references('ID')->on('taskstatus')
                ->onDelete('cascade');
            $table->foreign('priorityID')
                ->references('ID')->on('taskpriority')
                ->onDelete('cascade');
            $table->foreign('personID')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('taskCreatorID')
                ->references('id')->on('users')
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
        Schema::dropIfExists('task');
    }
}
