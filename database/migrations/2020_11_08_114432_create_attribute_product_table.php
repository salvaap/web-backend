<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory.attribute_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('inventory.attributes')->onDelete('cascade')->nullable();
            $table->foreignId('product_id')->constrained('inventory.products')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory.attribute_product');
    }
}
