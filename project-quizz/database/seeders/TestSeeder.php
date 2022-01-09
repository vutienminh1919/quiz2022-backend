<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestSeeder extends Seeder
{

    public function run()
    {

        DB::table('tests')->insert(
            [
                [
                    'test' => "Test 1",
                ],
                [
                    'test' => "Test 2",
                ],
                [
                    'test' => "Test 3",
                ],
            ]
        );

    }
}
