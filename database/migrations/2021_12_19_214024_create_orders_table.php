<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained()
                ->onDelete("cascade");
            $table->string("address")->nullable();
            $table->text("note")->nullable();
            $table->string("phone")->nullable();
            $table->decimal("total", 30, 0)->nullable();
            $table
                ->enum("status", ["Pending", "Delivered", "Rejected"])
                ->default("Pending");
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
        Schema::dropIfExists("orders");
    }
}
