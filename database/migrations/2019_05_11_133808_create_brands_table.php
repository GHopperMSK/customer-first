<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->unsignedBigInteger('container_id')->nullable()->after('id');;
            $table->foreign('container_id')->references('id')->on('item_containers')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function($table) {
            $table->dropForeign(['container_id']);
        });

        Schema::dropIfExists('brands');
    }
}
