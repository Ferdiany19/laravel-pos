<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStockItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('user_id');
            $table->integer('stock');
            $table->bigInteger('price')->nullable();
            $table->date('expire');
            $table->timestamps();
        });
        Schema::table('items',function(Blueprint $table){
            $table->enum('method_stock',['fifo','lifo'])->after('image');
            $table->integer('warning_expire')->after('method_stock');
            $table->dropColumn('stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_items');
    }
}
