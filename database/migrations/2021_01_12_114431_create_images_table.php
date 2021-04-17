<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media.images', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('absolute_path')->unique()->nullable();
            $table->string('relative_path')->unique()->nullable();
            $table->foreignId('gallery_id')->constrained('media.galleries')->onDelete('cascade');
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
        Schema::dropIfExists('media.images');
    }
}
