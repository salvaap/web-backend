<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeProductValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory.attribute_product_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_product_id')->constrained('inventory.attribute_product')->onDelete('cascade')->nullable();
            $table->foreignId('value_id')->constrained('inventory.values')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory.attribute_product_value');
    }
}
