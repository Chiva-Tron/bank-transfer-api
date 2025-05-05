<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Account::create([
            'owner_name' => 'Alice',
            'balance' => 500,
        ]);

        \App\Models\Account::create([
            'owner_name' => 'Bob',
            'balance' => 300,
        ]);
    }
}
