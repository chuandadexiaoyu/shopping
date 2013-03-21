<?php

class CartItemsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('cart_items')->delete();
		$cart_items = array(
            array(
                'cart_id' => 1,
                'item_id' => 9,
                'acct_id' => 58250,
                'quantity'=> 1,
                'price_approx' => 300,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 1,
                'item_id' => 10,
                'acct_id' => 58250,
                'quantity'=> 10,
                'price_approx' => 15,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 1,
                'item_id' => 11,
                'acct_id' => 58250,
                'quantity'=> 2,
                'price_approx' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 1,
                'item_id' => 13,
                'acct_id' => 58250,
                'quantity'=> 1,
                'price_approx' => 5,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 2,
                'item_id' => 1,
                'acct_id' => 60300,
                'quantity'=> 20,
                'price_approx' => 5,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 3,
                'item_id' => 4,
                'acct_id' => 62100,
                'quantity'=> 1,
                'price_approx' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 3,
                'item_id' => 5,
                'acct_id' => 62100,
                'quantity'=> 1,
                'price_approx' => 30,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 6,
                'item_id' => 6,
                'acct_id' => 62100,
                'quantity'=> 1,
                'price_approx' => 75,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 4,
                'item_id' => 12,
                'acct_id' => 61200,
                'quantity'=> 1,
                'price_approx' => 22000,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 4,
                'item_id' => 3,
                'acct_id' => 61100,
                'quantity'=> 1,
                'price_approx' => 25,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 7,
                'item_id' => 7,
                'acct_id' => 76200,
                'quantity'=> 1,
                'price_approx' => 60,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 7,
                'item_id' => 8,
                'acct_id' => 76200,
                'quantity'=> 1,
                'price_approx' => 120,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 7,
                'item_id' => 14,
                'acct_id' => 76100,
                'quantity'=> 1,
                'price_approx' => 800,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'cart_id' => 7,
                'item_id' => 10,
                'acct_id' => 58250,
                'quantity'=> 10,
                'price_approx' => 15,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
		);

		DB::table('cart_items')->insert($cart_items);
	}
}
