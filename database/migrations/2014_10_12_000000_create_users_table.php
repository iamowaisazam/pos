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
            $table->id(); 
            $table->string('name'); 
            $table->integer('company_id')->nullable(); 
            $table->unsignedBigInteger('role_id')->nullable(); 
            $table->string('email')->unique(); 
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password'); 
            $table->rememberToken(); 
            $table->timestamps(); 
            $table->integer('status')->default(1); 
            $table->integer('created_by')->nullable(); 
            $table->text('permissions')->nullable(); 
            $table->text('profile_image')->nullable(); 
            $table->text('email_token')->nullable(); 
        });

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
