<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocatedTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocated_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personID');
            $table->string('personName');
            $table->unsignedBigInteger('taskID');
            $table->string('description')->nullable();
            $table->float('timeAllocated')->default(0);
            $table->string('allocateDate')->nullable();
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
        Schema::dropIfExists('allocated_times');
    }
}
