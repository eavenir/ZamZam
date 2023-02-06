<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('Id')->primary();
            $table->string('EmployeeName')->length(60);
            $table->string('EmployeeName_Arabic')->length(60);
            $table->string('EmployeeCategory')->length(20);
            $table->double('Balance')->default('0');
            $table->string('Cell')->length(20);
            $table->string('Address')->length(160);
            $table->double('BasicSalaryAllowance')->default('0');
            $table->double('TransportAllowance')->default('0');
            $table->double('FoodAllowance')->default('0');
            $table->double('AccomodationAllowance')->default('0');
            $table->double('PRAlowance')->default('0');
            $table->double('ExtraAllowance')->default('0');
            $table->double('WorkingHour')->default('0');
            $table->date('HiringDate');
            $table->date('FireDate');
            $table->string('Nationality')->length(30);
            $table->string('PassportNo');
            $table->date('PassportExpireDate');
            $table->string('WorkPermit');
            $table->date('WorkPermitExpiryDate');
            $table->string('DrivingLicense');
            $table->date('DrivingLicenseExpiryDate');
            $table->string('MuncipalityCard');
            $table->date('MuncipalityCardExpiryDate');

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
        Schema::dropIfExists('employees');
    }
}
