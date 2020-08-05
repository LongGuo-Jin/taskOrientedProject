<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('organization')->unique();
            $table->string('short_name')->nullable();
            $table->string('long_name')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('Taxpayer')->nullable();
            $table->string('VATNumber')->nullable();
            $table->string('registrationNumber')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('Manager')->nullable();
            $table->string('ContactPerson')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        \App\Organization::forceCreate([
            'organization' => 'AteLje',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
