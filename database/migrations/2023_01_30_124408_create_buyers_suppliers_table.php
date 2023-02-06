<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers_suppliers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('AccountId');
            $table->foreign('AccountId')->references('id')->on('account_heads')->onDelete('cascade');
            $table->string('AccountName')->length(60);
            $table->string('AccountName_Arabic')->length(60);
            $table->string('AccountType')->length(15);
            $table->double('Balance')->default(0);
            $table->string('Cell')->length(20);
            $table->string('ContactPerson')->length(60);
            $table->string('Address');
            $table->string('VatNo')->length(25);
            $table->string('BankDetail');
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
        Schema::dropIfExists('buyers_suppliers');
    }
}
