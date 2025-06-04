<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomSession;

class CustomSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  \App\Models\CustomSession::factory()->session2018()->create();
        CustomSession::factory()->session2019()->create();
        CustomSession::factory()->session2020()->create();
        CustomSession::factory()->session2021()->create();
        CustomSession::factory()->session2022()->create();
        CustomSession::factory()->session2025()->create();
    }
}
