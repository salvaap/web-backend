<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account.sale_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('account.sales')->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('inventory.variants')->onDelete('cascade');
            $table->unsignedBigInteger('amount');
            $table->decimal('price', 10, 2);
            $table->decimal('sub_total', 10, 2);
            $table->unsignedInteger('discount')->nullable();
            $table->decimal('total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account.sale_variant');
    }
}
