<?php

class CartsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('carts')->delete();
		$carts = array(
            array(
                'id' => 1,
                'user_id' => 2,
                'shopping_date' => '2012-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 2,
                'user_id' => 4,
                'shopping_date' => '2012-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 3,
                'user_id' => 5,
                'shopping_date' => '2012-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 4,
                'user_id' => 6,
                'shopping_date' => '2012-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 5,
                'user_id' => 8,
                'shopping_date' => '2012-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 6,
                'user_id' => 5,
                'shopping_date' => '2012-03-21',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 7,
                'user_id' => 8,
                'shopping_date' => '2012-03-21',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
		);

		DB::table('carts')->insert($carts);
	}

}
