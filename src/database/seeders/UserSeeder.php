<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
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
        $param = [
            'name' => '一般ユーザー1',
            'email' => 'test1@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ];
        User::create($param);

        $param = [
            'name' => '一般ユーザー2',
            'email' => 'test2@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ];
        User::create($param);
    }
}
