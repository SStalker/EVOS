<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Prof',
            'email' => 'prof@prof.de',
            'password' => bcrypt('prof')
        ]);
    }
}
