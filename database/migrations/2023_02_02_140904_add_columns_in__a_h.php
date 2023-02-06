<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInAH extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_heads', function (Blueprint $table) {
            $table->string('AccountHead_Arabic')->length(40);
            $table->string('Cell')->length(20);
            $table->string('Email')->length(20);
            $table->text('Address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_heads', function (Blueprint $table) {
            //
        });
    }
}
