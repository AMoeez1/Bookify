<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("home");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showRegister()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'role' => 'required',
            'password'=> 'required|min:8',
        ]);

        if($validate) {
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'role'=> $request->role,
                'password'=> bcrypt($request->password),
            ]);
            if($user){
                Auth::login($user);
                return redirect()->route('home')->with('success','Regisered successfully');
            } else {
                return back()->withErrors(['Error' => 'Something went wrong registering']);
            }
        } else {
            return back()->withErrors(['Error' => 'Validation Failed']);
        }
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if($credentials){
            if(Auth::attempt($credentials)){
                return redirect()->route('home');
            } else {
                return back()->withErrors(['Error' => 'Something Went wrong!']);
            }
        } else {
            return back()->withErrors(['Error'=> 'Invalid Credentials']);
        }   
    }

    public function Logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
    public function profile()
    {
        return view('profile');
    }
}
