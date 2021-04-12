<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Hashing\BcryptHasher;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'pizzeria@admin.com',
            'password' => bcrypt('pizzeria'),
            'address' => 'pizzeria',
            'cpf'=>0000000000,
            'photo' => null
        ]);
        $user->assignRole('super_administrador');
    }
}
