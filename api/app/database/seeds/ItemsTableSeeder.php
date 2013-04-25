<?php

class ItemsTableSeeder extends Seeder {

    public function run()
    {
        $items = array(
            array(
                'id' => 1,
                'name' => 'Windex',
                'details' => '',
                'sku' => '2383243XDF',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 2,
                'name' => 'Pencils',
                'details' => '6 boxes of yellow pencils',
                'sku' => 'LKJSDF8234723',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 3,
                'name' => 'First aid kit',
                'details' => 'For big emergencies and stuff',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 4,
                'name' => 'pliers',
                'details' => '',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 5,
                'name' => 'staple gun',
                'details' => '\'cause I like guns. ;-),',
                'sku' => '9345lsfjKSDFJ',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 6,
                'name' => 'water pump',
                'details' => 'one of the red ones',
                'sku' => 'KLJSDFKUEWRKJN',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 7,
                'name' => 'chair',
                'details' => 'comfy lime green office chair',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 8,
                'name' => 'office table',
                'details' => 'somewhere cozy to rest my head',
                'sku' => 'LSDKEUIWER',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 9,
                'name' => 'propane',
                'details' => '100 gallons ought to do it.',
                'sku' => 'LKWERKJSDF',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 10,
                'name' => 'beer',
                'details' => 'just 20 gallons of this. Gonna be a fun night.',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 11,
                'name' => '2 packs of DVD-ROMs',
                'details' => 'for all my pr0n',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 12,
                'name' => 'tractor',
                'details' => 'while you\'re in town, why don\'t you pick one up?',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 13,
                'name' => 'squeegee',
                'details' => '',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 14,
                'name' => 'printer',
                'details' => 'Time to print some stuff out.',
                'sku' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('items')->insert($items);
    }

}