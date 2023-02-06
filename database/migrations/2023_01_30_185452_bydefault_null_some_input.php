<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BydefaultNullSomeInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('EmployeeCategory')->length(20)->nullable()->change();
            $table->string('Cell')->length(20)->nullable()->change();
            $table->string('Address')->length(160)->nullable()->change();
            $table->date('HiringDate')->nullable()->change();
            $table->date('FireDate')->nullable()->change();
            $table->string('Nationality')->length(30)->nullable()->change();
            $table->string('PassportNo')->nullable()->change();
            $table->date('PassportExpireDate')->nullable()->change();
            $table->string('WorkPermit')->nullable()->change();
            $table->date('WorkPermitExpiryDate')->nullable()->change();
            $table->string('DrivingLicense')->nullable()->change();
            $table->date('DrivingLicenseExpiryDate')->nullable()->change();
            $table->string('MuncipalityCard')->nullable()->change();
            $table->date('MuncipalityCardExpiryDate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
