<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media.galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('access.merchants')->onDelete('cascade');
            $table->enum('type', ['product', 'merchant', 'avatar', 'identifier']);
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
        Schema::dropIfExists('media.galleries');
    }
}
