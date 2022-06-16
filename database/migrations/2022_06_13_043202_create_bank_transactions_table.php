<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('currency_id');
            $table->decimal('amount', 10, 2);
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->text('transaction_details')->nullable();
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
        Schema::dropIfExists('bank_transactions');
    }
}
