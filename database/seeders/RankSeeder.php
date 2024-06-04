<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Rank;
use Hash;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ranks')->insert([
            'name' => 'Đồng',
            'value' => 1,
            'discount' => 5,
            'description' => "Rank beginer"
        ]);
    }
}
