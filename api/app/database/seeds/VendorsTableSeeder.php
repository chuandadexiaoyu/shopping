<?php

class VendorsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('vendors')->delete();

		$vendors = array(
            array(
                'id' => 1,
                'name' => 'Home Depot',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 2,
                'name' => 'Wallmart',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 3,
                'name' => 'Target',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 4,
                'name' => 'Hopaco',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 5,
                'name' => 'Cost-U-Less',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 6,
                'name' => 'HPM',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 7,
                'name' => 'Aloha Electric',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 8,
                'name' => 'Central Supply',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 9,
                'name' => 'Longs',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 10,
                'name' => 'Ben Franklin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 11,
                'name' => 'Hilo Rice Mill',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 12,
                'name' => 'Sustainable Island Products',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 13,
                'name' => 'Del\'s Farm Supply',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 14,
                'name' => 'Nursery Things',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 15,
                'name' => 'Garden Exchange',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 16,
                'name' => 'Office Max',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 17,
                'name' => 'BEI',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 18,
                'name' => 'Water Works',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 19,
                'name' => 'Wesco',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
		);

		DB::table('vendors')->insert($vendors);
	}

}
