<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_featured")->default(false);
            $table->string("image")->nullable();
            $table->boolean("is_instock")->default(true);
            $table->decimal("price", 30, 0)->nullable();
            $table
                ->foreignId("category_id")
                ->constrained("categories")
                ->onDelete("cascade");
            $table->json("colors");
            $table->json("sizes");
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
        Schema::dropIfExists("products");
    }
}
