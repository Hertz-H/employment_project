<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
class ServiceController extends Controller
{
    public function load(){
  $data=Service::all()->where('is_active',1);
        return view('template.services')->with("data",$data);
    }
    public function loadAdd(){

        return view('dashboard.add_service');
    }
    public function add(Request $request){
        Validator::validate($request->all(),[
            'title'=>['regex:/(^([a-zA-z]+)(\d+)?$)/'],
            'description'=>['regex:/(^([a-zA-z]+)(\d+)?$)/'],
           
        ],[
            'title.regex'=>'tilte must contain letters',
             'description.regex'=>'description must contain letters',
        ]);
        $service=new Service();
        $service->title=$request->title;
        $service->description=$request->description;
   
        if($service->save()){
           //  return route('companies')->with([ 'success'=>'created successfully' ]);
        }
       else{
           return back();
       }
        return view('dashboard.add_service');
    }


    public function updatePage(Request $request){
        $data=Service::find($request->id);
        if(isset($data)){
            echo "there is data "  ;
        }
      
        // $data=Service::all();

        return view('dashboard.update_service')->with("data",$data);
    }
    public function update(Request $request){
        echo $request->id   ;
        Service::where('id',  $request->id)
                ->update([
                           'title'=>$request->title,
                           'description'=>$request->description
                           ]
                        );
 

        return redirect('list_services');
    }
    

    public function activate(Request $request){
        echo $request->id ;
        echo $request->active ;
        $active=1;
        if($request->active==1){
            $active=0;
        }
      
        Service::where('id',  $request->id)
                ->update([
                           'is_active'=>$active,
                           ]
                        );
        return redirect('list_services');
    }






    public function list(){
        $data=Service::all();
        // $data=Service::all()->where("is_active",1);

        return view('dashboard.list_services')->with("data",$data);
    }
    
}