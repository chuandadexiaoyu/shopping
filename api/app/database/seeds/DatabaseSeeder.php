<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CartsTableSeeder');
		$this->call('AccountsTableSeeder');
		$this->call('ItemsTableSeeder');
		$this->call('VendorsTableSeeder');
		$this->call('ItemVendorsTableSeeder');
		$this->call('CartItemsTableSeeder');
	}

}