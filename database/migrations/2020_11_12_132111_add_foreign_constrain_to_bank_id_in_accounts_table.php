<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignConstrainToBankIdInAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog.accounts', function (Blueprint $table) {
            $table->foreign('bank_id')->references('id')->on('catalog.banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog.accounts', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
        });
    }
}
