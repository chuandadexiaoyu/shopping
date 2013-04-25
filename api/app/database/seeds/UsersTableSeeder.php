<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $users = array(
            array(
                'id'        =>  1,
                'username'  =>  'admin',
                'nickname'  =>  'Administrator',
                'password'  =>  Hash::make('test'),
                'homepage'  =>  'admin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id'        =>  2,
                'username'  =>  'joel',
                'nickname'  =>  'Joel',
                'password'  =>  Hash::make('test'),
                'homepage'  =>  'admin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'id' => 3,
                'username' => 'john',
                'nickname' => 'John Maestu',
                'password' => Hash::make('test'),
                'homepage' => 'report',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'id' => 4,
                'username' => 'annalisa',
                'nickname' => 'Annalisa',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'id' => 5,
                'username' => 'todd',
                'nickname' => 'T-Lo',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'id' => 6,
                'username' => 'barcus',
                'nickname' => 'Barcus',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
           array(
                'id' => 7,
                'username' => 'sami',
                'nickname' => 'Sami',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
           array(
                'id' => 8,       
                'username' => 'tiki',
                'nickname' => 'Tiki',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}