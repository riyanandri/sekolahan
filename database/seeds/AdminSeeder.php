<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'type' => 'admin',
            'username' => 'riyan',
            'password' => Hash::make('qwe123')
        ]);
    }
}
