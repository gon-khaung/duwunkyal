<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWholesalePriceAndWholesaleQuantityToTable extends Migration
{
    public function up()
    {
        Schema::table("products", function (Blueprint $table) {
            $table->decimal("wholesale_price", 30, 0)->nullable();
            $table->decimal("wholesale_quantity", 30, 0)->nullable();
        });
    }
    public function down()
    {
        Schema::table("products", function (Blueprint $table) {
            //
        });
    }
}
