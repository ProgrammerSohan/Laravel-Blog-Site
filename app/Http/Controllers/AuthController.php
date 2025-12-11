<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function loginForm(Request $request){
        $data = [
            'pageTitle'=>'Login'
        ];
        return view('back.pages.auth.login',$data);

     }

     public function forgotForm(Request $request) {
        $data = [
            'pageTitle'=>'Forgot Password'

        ];
        return view('back.pages.auth.forgot',$data);
        
     }

     public function loginHandler(Request $request){
        //dd($request->all());
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //dd($fieldType);
        if($fieldType == 'email' ){
            $request->validate([
                'login_id'=>'required|email|exists:users,email',
                'password'=>'required|min:5'

            ],[
                'login_id.required'=>'Enter your email or username',
                'login_id.email'=>'Invalid email address',
                'login_id.exists'=>'No account found for this email'

            ]);

        }else{
            $request->validate([
                'login_id'=>'required|exists:users,username',
                'password'=>'required|min:5'
            ],[
                'login_id.required'=>'Enter your username or email',
                'login_id.exists'=>'No account found for this username'
                
            ]);

        }


     }



}
