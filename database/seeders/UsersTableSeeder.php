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
        App\User::create([
            'name' => 'tangkas',
            'username' => 'superadmin',
            'email' => 'tangkas@ezvillasbali.com',
            'password' => bcrypt('adminadmin'),
            'role_id' => 1
        ]);
        
        App\User::create([
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role_id' => 2
        ]);    
    }
}
