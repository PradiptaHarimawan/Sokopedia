<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\User;
use Session;

class UserController extends Controller
{
    //

    public function register(){
        $auth = Auth::check();
        return view('register',['auth'=> $auth]);
    }

    public function loginPage(){
        $auth = Auth::check();
        return view('login',['auth'=> $auth]);
    }

    public function homepage(){
        $auth = Auth::check();
        return view('home',['auth'=> $auth]);
    }

    public function admin(){
        $auth = Auth::check();
        return view('admin.admin', ['auth'=> $auth]);
    }

    public function store(Request $req){
        $this->validate($req, [
            'email' => 'required|Email|unique:App\User,email',
            'name' => 'required',
            'password' => 'required|min:5',
            'confirmation_password' => 'required|min:5|same:password'
        ]);

        $user = new User;

        $user->username = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->role = "member";
        $user->save();
        return redirect('/login');
    }

    public function login(Request $request){
        $userInfo = $request->only('email', 'password');
        
        $remember = $request->remember;

        if(Auth::attempt($userInfo)){
            if($remember){
            $rememberTokenName = Auth::getRecallerName();
            Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), 120);    
            }
            if(Auth()->user()->role == 'admin'){
                return redirect('/admin');
            }
            return redirect()->intended(route('home'));
        }

        //  if(Auth::attempt($userInfo, $remember)){
        //     $rememberTokenName = Auth::getRecallerName();
        //     Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), 120);
        //     //Cookie::queue('user',$data , 120);
        //     return redirect()->intended(route('home'));
            
        //  }
        return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
    }

    public function logout(){   
        
    $rememberMeCookie = Auth::getRecallerName();
    $cookie = Cookie::forget($rememberMeCookie);
    Session::flush();
    Auth::logout();

    return redirect('/')->withCookie($cookie);
    }


}
