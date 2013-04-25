<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('CartsTableSeeder');
		$this->call('AccountsTableSeeder');
		$this->call('ItemsTableSeeder');
		$this->call('VendorsTableSeeder');
		$this->call('ItemvendorsTableSeeder');
		$this->call('CartitemsTableSeeder');
		$this->call('ShoppingDatesTableSeeder');
	}

}