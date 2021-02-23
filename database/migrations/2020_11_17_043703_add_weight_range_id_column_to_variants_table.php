<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightRangeIdColumnToVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory.variants', function (Blueprint $table) {
            $table->unsignedBigInteger('weight_range_id')->nullable();
            $table->foreign('weight_range_id')->references('id')->on('inventory.weight_ranges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory.variants', function (Blueprint $table) {
            $table->dropForeign(['weight_range_id']);
            $table->dropColumn('weight_range_id');
        });
    }
}
