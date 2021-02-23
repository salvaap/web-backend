<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog.addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->text('additional_information')->nullable();
            $table->string('postal_code')->nullable();
            $table->foreignId('town_id')->constrained('catalog.towns')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('access.users')->onDelete('cascade');
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
        Schema::dropIfExists('catalog.addresses');
    }
}
