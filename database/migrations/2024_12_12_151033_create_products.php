<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->string('unit')->nullable();

            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->double('price')->nullable();
            $table->string('category')->nullable();
            $table->string('thumbnail')->nullable();

            $table->string('gallery1')->nullable();
            $table->string('gallery2')->nullable();
            $table->string('gallery3')->nullable();
            $table->string('gallery4')->nullable();
            $table->string('gallery5')->nullable();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            
            $table->integer('status')->default(1);
            $table->integer('created_by')->default(0);

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
        Schema::dropIfExists('products');
    }
};
