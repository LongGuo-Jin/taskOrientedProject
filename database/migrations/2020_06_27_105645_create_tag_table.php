<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('name');
            $table->integer('tagtype')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('color')->nullable();
            $table->integer('colorValue')->nullable();
            $table->string('note')->nullable();
            $table->longText('description')->nullable();
            $table->integer('show')->default(1);
            $table->integer('pinned')->default(0);
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
        Schema::dropIfExists('tag');
    }
}
