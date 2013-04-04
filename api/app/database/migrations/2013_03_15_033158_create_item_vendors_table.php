<?php

use Illuminate\Database\Migrations\Migration;

class CreateItemVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_vendors', function($table) {
			$table->integer('item_id')->unsigned();
			$table->integer('vendor_id')->unsigned();
			$table->boolean('confirmed')->default(0);
			$table->decimal('last_known_price',6,2)->nullable();			
			$table->timestamps();
			$table->primary(array('item_id', 'vendor_id'));	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_vendors');
	}

}