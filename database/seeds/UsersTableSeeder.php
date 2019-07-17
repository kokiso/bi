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
        $admin = \App\User::create([
            'full_name'     => 'admin2 admin2',
            'email'    => 'admin2@admin.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
