<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access.action_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')->constrained('access.actions')->onDelete('cascade')->nullable();
            $table->foreignId('profile_id')->constrained('access.profiles')->onDelete('cascade')->nullable();
            $table->boolean('create')->default(false);
            $table->boolean('read')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access.action_profile');
    }
}
