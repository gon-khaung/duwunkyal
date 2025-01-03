<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sitecontacts", function (Blueprint $table) {
            $table->id();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("email")->nullable();
            $table->string("open_time")->nullable();
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
        Schema::dropIfExists("site_contacts");
    }
}
