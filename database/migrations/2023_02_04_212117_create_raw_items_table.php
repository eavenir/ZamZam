<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_items', function (Blueprint $table) {
            $table->integer('ItemId')->autoIncrement();
            $table->string('ItemName')->length(60);
            $table->string('ItemName_Arabic')->length(60);
            $table->integer('ItemSubCategoryId');
            $table->foreign('ItemSubCategoryId')->references('SubCategoryId')->on('item_sub_categories')->onDelete('cascade');
            $table->string('Unit')->length(20);
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
        Schema::dropIfExists('raw_items');
    }
}
