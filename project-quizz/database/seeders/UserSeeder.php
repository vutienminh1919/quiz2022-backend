<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//
//        $user = new User([
//            'name' => 'minh',
//            'email' => 'minh@gmail.com',
//            'password' => Hash::make('12345678')
//        ]);
//        $user->save();

        User::factory()->count(10)->create();
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'master@master.com',
            'password' => Hash::make('12345678'),
            'role' => 2
        ]);




    }
}
