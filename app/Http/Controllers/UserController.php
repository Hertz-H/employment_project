<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function load(){
        $data=User::all()->where('is_active',1);
              return view('template.services')->with("data",$data);
          }
    public function loadAdd(){

        return view('dashboard.add_user');
    }
    public function add(Request $request){
        Validator::validate($request->all(),[
            'name'=>['required','min:3','max:50'],
            'email'=>['required','email']
        ],[
            'name.required'=>'name is required',
            'name.min'=>'name must be at least 3 letters',
            'name.max'=>'name must be at most 50 letters',
            'email.required'=>'email is required',
           

           
        ]);
   
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make(12345678);
        if($user->save()){
            return redirect('list_users')->with([ 'success'=>'created successfully' ]);
        }
        else{
            return redirect('list_users')->with([ 'error'=>'creation failed' ]);
        }
        
    }
    public function updatePage(Request $request){
        $data=User::find($request->id);

        return view('dashboard.update_user')->with("data",$data);
    }

    public function update(Request $request){
        echo $request->id   ;
        User::where('id',  $request->id)
                ->update([
                           'name'=>$request->name,
                           'email'=>$request->email
                           ]
                        );
 

        return redirect('list_users');
    }
    public function list(){
        $data=User::all();
        
        return view('dashboard.list_users')->with("data",$data);
    }


    public function activate(Request $request){
        echo $request->id ;
        echo $request->active ;
        $active=1;
        if($request->active==1){
            $active=0;
        }
      
        User::where('id',  $request->id)
                ->update([
                           'is_active'=>$active,
                           ]
                        );
        return redirect('list_users');
    }






    public function signup(){


        return view('template.sign_up');
    }


    public function register(Request $request){

        Validator::validate($request->all(),[
            'name'=>['required','min:3','max:50'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:6'],
            'confirm_pass'=>['same:password']


        ],[
            'name.required'=>'this field is required',
            'name.min'=>'can not be less than 3 letters', 
            'email.unique'=>'duplicated email',
            'email.required'=>'this field is required',
            'email.email'=>'incorrect email format',
            'password.required'=>'password is required',
            'password.min'=>'password should not be less than 6',
            'confirm_pass.same'=>'password dont match',


        ]);

        $u=new User();
        $u->name=$request->name;
        $u->password=Hash::make($request->password);
        $u->email=$request->email;
       echo" register";
        if($u->save()){
            $u->attachRole('user');
            return redirect('login');
            
        }

      
        return back()->with(['error'=>'can not create user']);
        
    }

    public function login(){

        return view('template.log_in');
    }


    public function doLogin(Request $request){
      
            Validator::validate($request->all(),[
                'email'=>['email','required','min:3','max:50'],
                'password'=>['required','min:6']
    
    
            ],[
                'email.required'=>'email is required',
                'password.min'=>'password can not be less than 6 letters', 
                'password.required'=>'password is required', 
            ]);
  
   // 'is_active'=>1
            if(Auth::attempt(['email'=>$request->email,
                            'password'=>$request->password])){

                if(Auth::user()->hasRole('admin'))
                return redirect('list_users');
                else 
                return redirect('profile');
    
            
            }
            else {
                return 
                redirect('/login')
                ->with(['error'=>'incorerct username or password ']);
            }
    
             
   
    }

    public function logout(){
        Auth::logout();
     
        return redirect('/login');
    }  
   
}
