<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToHoldingAccountWitdraws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holding_account_witdraws', function (Blueprint $table) {
            //
            $table->bigInteger('transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holding_account_witdraws', function (Blueprint $table) {
            //
            $table->dropColumn('transaction_id');
        });
    }
}
