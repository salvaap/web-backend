<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory.products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_variant')->default(false);
            $table->boolean('in_offer')->default(false);
            $table->string('offer_discount')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('preparation_days')->nullable();
            $table->foreignId('category_id')->constrained('inventory.categories')->onDelete('cascade');
            $table->boolean('is_blocked')->default(false);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('inventory.products');
    }
}
