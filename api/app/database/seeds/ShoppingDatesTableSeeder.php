<?php

class ShoppingDatesTableSeeder extends Seeder {

    public function run()
    {
        $shoppingdates = array(
           array(
                'id' => 1,
                'shopping_date' => '2013-03-14',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 2,
                'shopping_date' => '2013-03-21',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 3,
                'shopping_date' => '2013-03-28',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 4,
                'shopping_date' => '2013-04-04',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 5,
                'shopping_date' => '2013-04-11',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 6,
                'shopping_date' => '2013-04-18',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 7,
                'shopping_date' => '2013-04-25',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 8,
                'shopping_date' => '2013-05-02',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
           array(
                'id' => 9,
                'shopping_date' => '2013-05-09',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('shoppingdates')->insert($shoppingdates);
    }

}