<?php

class CartsTableSeeder extends Seeder {

    public function run()
    {
        $carts = array(
           array(
                'user_id' => 2,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 4,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 5,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 6,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 8,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 5,
                'shopping_date' => '2013-03-21',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id' => 8,
                'shopping_date' => '2013-03-21',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('carts')->insert($carts);
    }

}