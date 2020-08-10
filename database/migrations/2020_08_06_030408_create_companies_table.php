<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('short_name')->nullable();
            $table->string('long_name')->nullable();
            $table->string('type')->nullable();
            $table->string('industry')->nullable();
            $table->tinyInteger('Taxpayer')->nullable();
            $table->string('VATNumber')->nullable();
            $table->string('registrationNumber')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('Manager')->nullable();
            $table->string('ContactPerson')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('messenger')->nullable();
            $table->string('swift_bic')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('companyID')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
