<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionProvider::firstOrCreate(['name' => 'Apple']);

        SubscriptionProvider::firstOrCreate(['name' => 'Google']);
    }
}
