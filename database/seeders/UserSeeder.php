<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $users = [
            [
                'name' => 'Asif',
                'email' => 'asif@gmail.com',
                'password' => 12345678,
            ],
            [
                'name' => 'Asim',
                'email' => 'asim@gmail.com',
                'password' => 12345678,
            ],
        ];
        
            User::insert($users);
        

    }
}
