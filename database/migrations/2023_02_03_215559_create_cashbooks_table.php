<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbooks', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->string('FromAccount')->length(100);
            $table->string('ToAccount')->length(100);
            $table->double('Amount');
            $table->string('Remarks');
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
        Schema::dropIfExists('cashbooks');
    }
}
