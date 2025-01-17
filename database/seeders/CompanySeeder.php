<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        //
//        $companies = [];
//        $faker = Faker::create();
//
//        foreach (range(1,10) as $index){
//            $company = [
//
//                'created_at'=>now(),
//                'updated_at'=>now(),
//            ];
//
//            $companies[]=$company;
//        }
////        DB::table('companies')->truncate();
//        DB::table('companies')->insert($companies);

        Company::factory()->count(10)->create();
    }
}
