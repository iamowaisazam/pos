<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->nullable();
            $table->string('ref')->nullable();
            $table->string('tracking_id')->nullable();
            $table->integer('is_paid')->nullable()->default(0);
            
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_contact')->nullable();
            
            $table->string('customer_country')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_postalcode')->nullable();
            $table->string('customer_address')->nullable();

            $table->text('items')->nullable();

            $table->double('subtotal')->nullable();
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();
            $table->double('total')->nullable();
         
            $table->text('notes')->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
