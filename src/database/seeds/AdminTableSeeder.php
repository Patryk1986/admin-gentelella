<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Cristian Militaru',
            'email' => 'cristianmilitaru1979@gmail.com',
            'password' => bcrypt('asdasd'),
        ]);
    }
}
