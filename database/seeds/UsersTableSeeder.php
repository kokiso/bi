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
            'name'     => 'administrador',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin123'),
        ]);

        $user = \App\User::create([
            'name'     => 'usuario',
            'email'    => 'usuario@usuario.com.br',
            'password' => bcrypt('usuario123'),
        ]);
    }
}
