<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('banner_home')->nullable();
            $table->string('banner_home_2')->nullable();
            $table->string('banner_home_product_new')->nullable();
            $table->string('banner_home_category_new')->nullable();
            $table->string('banner_shop')->nullable();
            $table->string('banner_home_category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('banner_home');
            $table->dropColumn('banner_home_2');
            $table->dropColumn('banner_home_product_new');
            $table->dropColumn('banner_home_category_new');
            $table->dropColumn('banner_shop');
            $table->dropColumn('banner_home_category');
        });
    }
}
