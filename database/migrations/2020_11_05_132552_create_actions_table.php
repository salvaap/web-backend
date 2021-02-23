<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access.actions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('access.actions')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('action')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('application_id')->constrained('access.applications')->onDelete('cascade')->nullable();
            $table->enum('location', ['primary', 'sidebar', 'toolbar'])->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_component')->default(false);
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
        Schema::dropIfExists('access.actions');
    }
}
