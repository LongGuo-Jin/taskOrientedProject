<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskID');
            $table->string('description')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('isParent')->default(false);
            $table->unsignedBigInteger('parentID')->nullable();
            $table->foreign('taskID')
                ->references('id')->on('task')
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
        Schema::dropIfExists('check_lists');
    }
}
