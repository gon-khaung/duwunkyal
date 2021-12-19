<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("order_product", function (Blueprint $table) {
            $table->id();
            $table->decimal("solo_price", 30, 0)->nullable();
            $table->decimal("total", 30, 0)->nullable();
            $table->integer("quantity")->nullable();
            $table->string("size")->nullable();
            $table->string("color")->nullable();
            $table
                ->foreignId("order_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("product_id")
                ->constrained()
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("order_product");
    }
}
