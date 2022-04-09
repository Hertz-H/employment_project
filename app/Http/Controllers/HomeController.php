<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\Ad;

class HomeController extends Controller
{
    public function load(){
        $job=Job::select('jobs.*','companies.name','companies.logo','companies.location','companies.is_active')
        ->join('companies','jobs.company_id','=','companies.id')
        ->where('companies.is_active','1')
        ->where('jobs.is_active','1')
        ->get();
        $company = Company::All()->where('is_active','1');
        $ad=Ad::all()->where('is_active','1')->take(2);

        $data=[
           'job'=> $job,
           'company'=> $company,
           'ad'=> $ad

        ];
        return view('index')->with('data',$data);
    }

}
