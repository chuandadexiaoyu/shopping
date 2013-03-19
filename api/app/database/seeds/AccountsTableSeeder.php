<?php

class AccountsTableSeeder extends Seeder {

    public function run() {
        $accounts = array(
            array(
                'number' => 58250,
                'name' => 'HMS Classroom Costs',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'number' => 60300,
                'name' => 'HK Cleaning Products & Supplies',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 60400,
                'name' => 'HK Appliances & Fixtures Under $500',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 61100,
                'name' => 'HORT Supplies/Small Tools Under $500',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 61200,
                'name' => 'HORT Equipment over $500',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 62020,
                'name' => 'Crafts Shop State GE Tax',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 62100,
                'name' => 'MAINT Tools & Supplies Under $500  ',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 62250,
                'name' => 'MAINT Equipment Rental',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 62500,
                'name' => 'MAINT Pool Supplies',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 63100,
                'name' => 'NC Cottage Kits and Freight',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 63150,
                'name' => 'Construction Materials',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 76100,
                'name' => 'Office Equipment',
                'created_at' => new DateTime,
                'updated_at' => new DateTime 
            ),
            array(
                'number' => 76200,
                'name' => 'Office Supplies',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
        );

        DB::table( 'accounts' )->insert( $accounts );
    }
}
