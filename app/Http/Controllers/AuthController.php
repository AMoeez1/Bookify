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

    }

    /**
     * Show the form for creating a new resource.
     */
    public function showRegister()
    {
        return view("auth.register");
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
