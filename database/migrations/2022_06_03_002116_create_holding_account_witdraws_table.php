<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldingAccountWitdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holding_account_witdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('currency_id');
            $table->decimal('amount', 10, 2);
            $table->string('dr_cr', 2);
            $table->string('type', 20);
            $table->string('method', 20);
            $table->tinyInteger('status');
            $table->text('note')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
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
        Schema::dropIfExists('holding_account_witdraws');
    }
}
