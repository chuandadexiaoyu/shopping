<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();

		$users = array(
            array(
                'username' => 'admin',
                'nickname' => 'Administrator',
                'password' => Hash::make('test'),
                'homepage' => 'admin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'username' => 'joel',
                'nickname' => 'Joel',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'username' => 'john',
                'nickname' => 'John Maestu',
                'password' => Hash::make('test'),
                'homepage' => 'report',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'username' => 'annalisa',
                'nickname' => 'Annalisa',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'username' => 'todd',
                'nickname' => 'T-Lo',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'username' => 'barcus',
                'nickname' => 'Barcus',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
           array(
                'username' => 'sami',
                'nickname' => 'Sami',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
           array(
                'username' => 'tiki',
                'nickname' => 'Tiki',
                'password' => Hash::make('test'),
                'homepage' => 'entry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),

		);

		DB::table('users')->insert($users);
	}

}
