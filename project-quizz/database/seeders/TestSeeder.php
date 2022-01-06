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
                    'title' => "Test 1",
                ],
                [
                    'title' => "Test 2",
                ],
                [
                    'title' => "Test 3",
                ],
            ]
        );

    }
}
