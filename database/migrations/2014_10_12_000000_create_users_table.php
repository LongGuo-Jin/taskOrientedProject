<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->integer('roleID')->unsigned();
            $table->integer('addressID')->nullable();
            $table->integer('administrativeID')->nullable();
            $table->string('nameFirst');
            $table->string('nameMiddle');
            $table->string('nameFamily');
            $table->integer('gender')->default(1);
            $table->date('birthday')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('addressType')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('messenger')->nullable();
            $table->string('nationalID')->nullable();
            $table->string('companyID')->nullable();
            $table->string('bankAccount')->nullable();
            $table->string('bank')->nullable();
            $table->string('swift_bic')->nullable();
            $table->longText('description')->nullable();
            $table->string('memoNotification')->nullable();
            $table->string('family')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nameTag');
            $table->integer('avatarType')->default(0);
            $table->string('avatarColor')->default("#8F8EC7");
            $table->integer('avatarColorValue')->default(13);
            $table->string('locale')->nullable();
            $table->string('filter_order')->default('214356');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('cascade');
        });

        \App\User::forceCreate([
            'nameFirst' => 'Afred',
            'nameFamily' => 'Antonijević',
            'organization_id' => 1,
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 1
        ]);

        \App\User::forceCreate([
            'nameFirst' => 'Ivan',
            'nameFamily' => 'Balan',
            'organization_id' => 1,
            'email' => 'test1@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 2
        ]);
        \App\User::forceCreate([
            'nameFirst' => 'Bitenc',
            'nameFamily' => 'Bitenc',
            'organization_id' => 1,
            'email' => 'test2@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 2
        ]);
        \App\User::forceCreate([
            'nameFirst' => 'Bojanovic',
            'nameFamily' => 'Bojanovic',
            'organization_id' => 1,
            'email' => 'test3@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 4
        ]);
        \App\User::forceCreate([
            'nameFirst' => 'Yang',
            'nameFamily' => 'Zhen',
            'organization_id' => 1,
            'email' => 'test4@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 2
        ]);
        \App\User::forceCreate([
            'nameFirst' => 'Jin',
            'nameFamily' => 'Longguo',
            'organization_id' => 1,
            'email' => 'test5@test.com',
            'password' => bcrypt('12345678'),
            'roleID' => 4
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
