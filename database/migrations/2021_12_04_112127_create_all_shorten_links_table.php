<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllShortenLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_shorten_links', function (Blueprint $table) {
            $table->id();
            $table->string('url_key')->unique();
            //$table->foreign('url_key')->references('url_key')->on('short_urls')->onDelete('cascade');
            $table->string('source');
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
        Schema::dropIfExists('all_shorten_links');
    }
}
