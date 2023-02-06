<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawItemsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_items_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('ItemId');
            $table->foreign('ItemId')->references('ItemId')->on('raw_items')->onDelete('cascade');
            $table->double('PRate');
            $table->double('VAT');
            $table->double('SRate');
            $table->double('Qty');
            $table->integer('StoreName');
            $table->foreign('StoreName')->references('StoreId')->on('stores')->onDelete('cascade');
            $table->integer('AccountId');
            $table->foreign('AccountId')->references('id')->on('account_heads')->onDelete('cascade');
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
        Schema::dropIfExists('raw_items_stocks');
    }
}
