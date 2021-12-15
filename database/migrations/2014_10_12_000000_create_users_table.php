<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table
                ->string("email")
                ->unique()
                ->nullable();
            $table
                ->text("firebase_uid")
                ->nullable()
                ->uniqid();
            $table->string("login_type")->nullable();
            $table
                ->enum("roles", ["admin", "comissioner", "normal"])
                ->default("normal");
            $table->string("password")->nullable();
            $table->integer("2d_comission")->nullable();
            $table->integer("3d_comission")->nullable();
            $table->integer("3d_odds")->nullable();
            $table->integer("2d_odds")->nullable();
            $table
                ->decimal("amount", 30, 0)
                ->nullable()
                ->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists("users");
    }
}
