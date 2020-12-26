<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['username' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'role' => 'admin']
        ]);
    }
}
