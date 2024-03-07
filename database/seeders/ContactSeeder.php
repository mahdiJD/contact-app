<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Company;
use Faker\Factory as Faker;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Contact::factory()->count(100)->create();
//        $faker = Faker::create();
//        $companies = Company::all();
//        $contacts=[];
//        //
//        foreach ($companies as $company) {
//            foreach (range(1,rand(1,10)) as $index) {
//                $contact = [
//                    'first_name' => $faker->firstName(),
//                    'last_name' => $faker->lastName(),
//                    'phone' => $faker->phoneNumber(),
//                    'email' => $faker->email(),
//                    'address' => $faker->address(),
//                    'company_id' => $company->id,
//                    'created_at' => now(),
//                    'updated_at' => now(),
//                ];
//                $contacts[] = $contact;
//            }
//        }
//        Contacts::insert($contacts);

    }
}
