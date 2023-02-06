<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->string('FromAccount')->length(60);
            $table->string('ExpenseType')->length(40);
            $table->double('Amount');
            $table->double('VATPercent');
            $table->double('VATAmount');
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
        Schema::dropIfExists('expenses');
    }
}
