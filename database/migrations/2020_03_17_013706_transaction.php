<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->text('address');
            $table->text('memo')->nullable();
            $table->integer('status');
            $table->datetime('transaction_date');
            $table->integer('delete_flag')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->integer('created_by_user_id')->nullable();
            $table->string('created_by_user_name')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('updated_by_user_id')->nullable();
            $table->string('updated_by_user_name')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
