<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account.sales', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('product_count');
            $table->decimal('sub_total', 10, 2);
            $table->unsignedInteger('discount')->nullable();
            $table->decimal('delivery', 6, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->foreignId('user_id')->constrained('access.users')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('access.merchants')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('catalog.payment_methods')->onDelete('cascade');
            $table->foreignId('sale_state_id')->constrained('catalog.sale_states')->onDelete('cascade');
            $table->timestamp('saled_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('account.sales');
    }
}
