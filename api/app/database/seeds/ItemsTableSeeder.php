<?php

class ItemsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('items')->delete();
		$items = array(
            array(
                'name' => 'Windex',
                'details' => '',
                'sku' => '2383243XDF',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'Pencils',
                'details' => '6 boxes of yellow pencils',
                'sku' => 'LKJSDF8234723',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'First aid kit',
                'details' => 'For big emergencies and stuff',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'pliers',
                'details' => '',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'staple gun',
                'details' => '\'cause I like guns. ;-),',
                'sku' => '9345lsfjKSDFJ',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'water pump',
                'details' => 'one of the red ones',
                'sku' => 'KLJSDFKUEWRKJN',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'chair',
                'details' => 'comfy lime green office chair',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'office table',
                'details' => 'somewhere cozy to rest my head',
                'sku' => 'LSDKEUIWER',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'propane',
                'details' => '100 gallons ought to do it.',
                'sku' => 'LKWERKJSDF',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'beer',
                'details' => 'just 20 gallons of this. Gonna be a fun night.',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => '2 packs of DVD-ROMs',
                'details' => 'for all my pr0n',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'tractor',
                'details' => 'while you\'re in town, why don\'t you pick one up?',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'squeegee',
                'details' => '',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'printer',
                'details' => 'Time to print some stuff out.',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
		);

		DB::table('items')->insert($items);
	}

}
