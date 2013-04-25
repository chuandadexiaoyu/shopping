<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartitemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartitems', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('cart_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('acct_id')->unsigned();
			$table->integer('quantity')->default(1);
			$table->decimal('price_approx',10,2)->nullable();
			$table->decimal('price_actual',10,2)->nullable();
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
        Schema::drop('cartitems');
    }

}
