<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $this->command->warn('No customers found. Please run CustomerSeeder first.');
            return;
        }

        // Create 1-3 accounts for each customer
        foreach ($customers as $customer) {
            $accountCount = rand(1, 30);

            for ($i = 0; $i < $accountCount; $i++) {
                Account::factory()->create([
                    'customer_id' => $customer->id,
                ]);
            }
        }

        // Create some specific status accounts for testing
        if ($customers->count() > 0) {
            // Create a paid account
            Account::factory()->paid()->create([
                'customer_id' => $customers->first()->id,
            ]);

            // Create an overdue account
            if ($customers->count() > 1) {
                Account::factory()->overdue()->create([
                    'customer_id' => $customers->skip(1)->first()->id,
                ]);
            }
        }
    }
}