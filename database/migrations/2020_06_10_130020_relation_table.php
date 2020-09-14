<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categorys')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('order_details', function (Blueprint $table){
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table){
            $table->foreign('role_user_id')->references('id')->on('role_users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('user_profiles', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['unit_id']);
        });

        Schema::table('orders', function (Blueprint $table){
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('order_details', function (Blueprint $table){
            $table->dropForeign(['order_id']);
            $table->dropForeign(['item_id']);
        });

        Schema::table('users', function (Blueprint $table){
            $table->dropForeign(['role_user_id']);
        });

        Schema::table('user_profiles', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
    }
}
