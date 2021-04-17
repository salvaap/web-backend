<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog.payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('payment_method_type_id')->constrained('catalog.payment_method_types')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('access.merchants')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog.payment_methods');
    }
}
