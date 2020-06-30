<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('fileName');
            $table->string('tmpFileName')->nullable();
            $table->string('extension')->nullable();
            $table->string('timestamp')->nullable();
            $table->unsignedBigInteger('personID');
            $table->unsignedBigInteger('taskID');
            $table->foreign('personID')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('attachment');
    }
}
