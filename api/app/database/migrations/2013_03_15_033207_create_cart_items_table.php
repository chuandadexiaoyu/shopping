<?php

use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_items', function($table) {
			$table->integer('cart_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('acct_id')->unsigned();
			$table->integer('quantity')->nullable();
			$table->decimal('price_approx',6,2)->nullable();
			$table->timestamps();
			$table->primary(array('cart_id', 'item_id', 'acct_id'));	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cart_items');
	}

}