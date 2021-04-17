<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValueVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory.value_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('value_id')->constrained('inventory.values')->onDelete('cascade')->nullable();
            $table->foreignId('variant_id')->constrained('inventory.variants')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory.value_variant');
    }
}
