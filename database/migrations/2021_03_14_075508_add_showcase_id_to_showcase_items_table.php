<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowcaseIdToShowcaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showcase_items', function (Blueprint $table) {
            $table->integer('showcase_id')->unsigned()->default(1);
            $table->foreign('showcase_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showcase_items', function (Blueprint $table) {
            $table->dropColumn('showcase_id');
        });
    }
}
