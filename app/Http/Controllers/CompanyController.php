<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\UploadFile;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{ 
    public function load(){
        $data = Company::All()->where('is_active','1');
        return view('template.company_page')->with("data",$data);
    }

    public function loadAdd(){

        return view('dashboard.add_company');
    }


    public function list(){

        $data = Company::with('jobs')->get();
        // return response( $data);
        // $data = Company::All();
        // if(isset($data)){
        //     echo "there is data "  ;
        // }
        return view('dashboard.list_companies')->with("data",$data);
    }
    public function updatePage(Request $request){
        $data=Company::find($request->id);
        if(isset($data)){
            echo "there is data "  ;
        }
      

        return view('dashboard.update_company')->with("data",$data);
    }
    public function update(Request $request){
        echo $request->id   ;
        $imageName=time().'.'.$request->logo->extension();
         $request->logo->move(public_path('images'),$imageName);
      
        Company::where('id',  $request->id)
                ->update([
                           'name'=>$request->title,
                           'logo'=>$imageName
                           ]
                        );
 

        return redirect('list_companies');
    }
    

    public function activate(Request $request){
        echo $request->id ;
        echo $request->active ;
        $active=1;
        if($request->active==1){
            $active=0;
        }
      
        Company::where('id',  $request->id)
                ->update([
                           'is_active'=>$active,
                           ]
                        );
        return redirect('list_companies');
    }













    public function add(Request $request){
        // echo $request->all;
        // echo $request->logo;
     
        Validator::validate($request->all(),[
            'name'=>['regex:/(^([a-zA-z]+)(\d+)?$)/'],
            // 'link'=>['regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/'],
            'location'=>['regex:/(^([a-zA-z]+)(\d+)?$)/'],
            'logo'=>['required'],
            // 'user_pass'=>['required','min:5']
        ],[
            'name.regex'=>'name must contain letters',
        //    ' link.regex'=>'link must vaild facebook format '
             'location.regex'=>'name must contain letters',
             'location.logo'=>'logo is required',
        ]);
     $company=new Company();
     $company->name=$request->name;
     $imageName=time().'.'.$request->logo->extension();
     $request->logo->move(public_path('images'),$imageName);
     $company->logo=$imageName;

    //  $company->logo=$request->logo;
     $company->location=$request->location;
     $company->link=$request->link;

     if($company->save()){
        return  redirect('list_companies');
        //  return route('companies')->with([ 'success'=>'created successfully' ]);
     }
    else{
        return back();
    }
    // echo  UploadFile::uploadFile($request->logo);
 
    }
}
