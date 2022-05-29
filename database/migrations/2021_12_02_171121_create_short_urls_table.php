<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('destination_url');
            $table->string('url_key')->unique();
            $table->boolean('single_use')->default(false);
            $table->boolean('track_visits')->default(true);
            $table->boolean('track_ip_address')->default(true);
            $table->boolean('track_operating_system')->default(true);
            $table->boolean('track_operating_system_version')->default(true);
            $table->boolean('track_browser')->default(true);
            $table->boolean('track_browser_version')->default(true);
            $table->boolean('track_referer_url')->default(true);
            $table->boolean('track_device_type')->default(true);
            $table->timestamp('activated_at')->nullable()->default(now());
            $table->timestamp('deactivated_at')->nullable();
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
        Schema::dropIfExists('short_urls');
    }
}
