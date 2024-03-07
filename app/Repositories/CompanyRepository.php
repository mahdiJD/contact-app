<?php
namespace App\Repositories;
use App\Models\Company;
class CompanyRepository
{
    public function pluck():array
    {
//        return Company::orderBy('name')->pluck('name' ,'id');

        $data = [];
        $companies = Company::orderBy('name')->get();
//        [
//            1 => 'google (4)'
//        ]
        foreach ($companies as $company){
            $data[$company->id] = $company->name . " (". $company->contact()
                ->count().") ";
        }
        return $data;
    }
}
