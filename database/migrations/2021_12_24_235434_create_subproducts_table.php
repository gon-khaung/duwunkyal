<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("subproducts", function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->boolean("is_instock")->default(true);
            $table
                ->foreignId("product_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("color_id")
                ->constrained('dynamic_names')
                ->onDelete("cascade");
            $table
                ->foreignId("size_id")
                ->constrained('dynamic_names')
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
        Schema::dropIfExists("subproducts");
    }
}
