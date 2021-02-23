<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account.purchases', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->nullable();
            $table->string('authorization_code')->nullable();
            $table->foreignId('merchant_id')->constrained('access.merchants')->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained('configuration.subscriptions')->onDelete('cascade');
            $table->foreignId('purchase_method_id')->constrained('configuration.purchase_methods')->onDelete('cascade');
            $table->decimal('total', 8, 2, true)->nullable();
            $table->boolean('payment_completed')->default(false);
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('account.purchases');
    }
}
