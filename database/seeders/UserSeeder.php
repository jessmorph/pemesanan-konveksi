<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'namaUser' => 'Super Admin',
            'username' => 'superadmin',
            'password' => 'password',
            'role_id' => 1,
        ]);

        $users = ['Agung Hidayat', 'Asep Saipudin', 'Becca Surica', 'Cecep Suparna', 'Deddy Corbuzier', 'Edwin Pranajaya'];
        foreach ($users as $user) {
            User::create([
                'namaUser' => $user,
                'username' => Str::slug($user, '_'),
                'password' => 'password',
                'role_id' => rand(2, 3),
            ]);
        }
    }
}
