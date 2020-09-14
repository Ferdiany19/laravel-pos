<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_returs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice',225)->nullable();
            $table->bigInteger('item_id')->nullable();
            $table->string('item_name',225);
            $table->string('supplier_name',225)->nullable();
            $table->string('user_name',225)->nullable();
            $table->string('customer_name',225)->nullable();
            $table->integer('stock');
            $table->date('expire')->nullable();
            $table->bigInteger('price')->nullable();
            $table->text('description');
            $table->enum('retur_dari',['c','g'])->comment('c : dari customer, g : dari gudang');
            $table->enum('pengecekan',['p','ta','tk'])->comment('p : proese, ta : terima, tk : tolak');
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
        Schema::dropIfExists('stock_returs');
    }
}
