<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory.variants', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->text('featured_image')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->decimal('price', 8, 2, true)->nullable();
            $table->decimal('length', 8, 2, true)->nullable();
            $table->decimal('width', 8, 2, true)->nullable();
            $table->decimal('height', 8, 2, true)->nullable();
            $table->foreignId('product_id')->constrained('inventory.products')->onDelete('cascade');
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
        Schema::dropIfExists('inventory.variants');
    }
}
