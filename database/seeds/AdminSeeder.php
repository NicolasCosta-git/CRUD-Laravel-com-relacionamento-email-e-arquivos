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
        ]);
        $user->assignRole('super_administrador');
    }
}
