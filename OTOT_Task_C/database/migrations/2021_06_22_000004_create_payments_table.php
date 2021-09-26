<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('fees',15,2)->nullable();
            $table->string('freelancer_ref')->nullable();
            $table->string('description')->nullable();
            $table->string('payer_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('invoice_ref')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('payment_amount', 15, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
