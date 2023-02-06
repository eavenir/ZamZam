<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->string('SalaryMonth')->length(10);
            $table->string('FromAccount')->length(60);
            $table->string('EmployeeName')->length(60);
            $table->double('SalaryAmount');
            $table->double('PaidAmount');
            $table->double('AdvanceIn');
            $table->double('AdvanceOut');
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
        Schema::dropIfExists('salaries');
    }
}
