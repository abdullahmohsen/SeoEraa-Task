<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'super admin',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('12345678'),
            'is_activated' => 1
        ]);
        $user->attachRole('super_admin');
    }
}
