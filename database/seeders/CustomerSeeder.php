<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific customers with user accounts
        // $customer1User = User::factory()->create([
        //     'name' => 'Benjie Lenteria',
        //     'email' => 'benjielenteria@yahoo.com',
        // ]);

        // Customer::factory()->create([
        //     'user_id' => $customer1User->id,
        //     'name' => 'Benjie Lenteria',
        //     'email' => 'benjielenteria@yahoo.com',
        //     'phone' => '09171234567',
        //     'address' => '123 Main St, Manila, Philippines',
        // ]);

        // $customer2User = User::factory()->create([
        //     'name' => 'Lentrix Hawkman',
        //     'email' => 'hawkmanlentrix@gmail.com',
        // ]);

        // Customer::factory()->create([
        //     'user_id' => $customer2User->id,
        //     'name' => 'Lentrix Hawkman',
        //     'email' => 'hawkmanlentrix@gmail.com',
        //     'phone' => '09179876543',
        //     'address' => '456 Oak Ave, Quezon City, Philippines',
        // ]);

        $customer3User = User::factory()->create([
            'name' => 'Cristino Algodon',
            'email' => 'cristinoalgodon@gmail.com',
        ]);

        Customer::factory()->create([
            'user_id' => $customer3User->id,
            'name' => 'Cristino Algodon',
            'email' => 'cristinoalgodon@gmail.com',
            'phone' => '09221234567',
            'address' => 'Cahayag, Tubigon, Bohol, Philippines',
        ]);

        // Create additional customers with user accounts
        Customer::factory(5)->withUser()->create();

        // Create some customers without user accounts (not registered online)
        // Customer::factory(3)->withoutUser()->create();
    }
}
