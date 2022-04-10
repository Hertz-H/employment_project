<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
  
    public function signup(){


        return view('template.sign_up');
    }

    public function register(Request $request){

        Validator::validate($request->all(),[
            'name'=>['required','min:3','max:50'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:5'],
            'confirm_pass'=>['same:password']


        ],[
            'name.required'=>'this field is required',
            'name.min'=>'can not be less than 3 letters', 
            'email.unique'=>'duplicated email',
            'email.required'=>'this field is required',
            'email.email'=>'incorrect email format',
            'password.required'=>'password is required',
            'password.min'=>'password should not be less than 3',
            'confirm_pass.same'=>'password dont match',


        ]);

        $u=new User();
        $u->name=$request->name;
        $u->password=Hash::make($request->password);
        $u->email=$request->email;
       echo" register";
        if($u->save()){
            $u->attachRole('user');
            return redirect('dashboard');
            // ->with(['success'=>'user created successful']);
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
                return redirect('list_companies');
                else 
                return redirect('dashboard');
    
            
            }
            else {
                return 
                redirect('login')
                ->with(['error'=>'incorerct username or password ']);
            }
    
             
   
    }

    public function logout(){
        Auth::logout();
     
        return redirect('/login');
    }  
   
}
