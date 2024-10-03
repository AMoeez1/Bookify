<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::inRandomOrder()->limit(5)->get();
        return view("home", ['books' => $books]);
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
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validate) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);
            if ($user) {
                Auth::login($user);
                return redirect()->route('profile')->with('Res', 'Regisered successfully! Now you can update your profile');
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
        if ($credentials) {
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            } else {
                return back()->withErrors(['Error' => 'Something Went wrong!']);
            }
        } else {
            return back()->withErrors(['Error' => 'Invalid Credentials']);
        }
    }

    public function Logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
    public function profile()
    {
        // $books = session('books', []);
        $author = Auth::user()->id;
        $books = Books::where('author_id', $author)->get();

        return view('profile',)->with('books', $books);
    }

    public function edit_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'image' => 'mimes:jpg,png,webp,jpeg',
        ]);
        $user = User::find(Auth::user()->id);

        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->about = $request->input('about');
            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $image = $request->file('image')->store('users', 'public');
                $user->image = $image;
            } else {
                $user->image == null;
            }
            $user->save();
            return redirect()->route('profile')->with('Res', 'Profile Updated Successfully');
        } else {
            return back()->withErrors(['Error' => 'Something went wrong']);
        }
    }

    public function remove_profile(){
        $user = User::find(Auth::user()->id);
        if($user->image){
            $deleted = Storage::disk('public')->delete($user->image);
            $user->image = null;
            $user->save();
            if($deleted){
                return redirect()->route('profile')->with('Res', 'Profile Updated Successfully');
            } else {
                return back()->withErrors(['Error'=> 'Error Removing Image']);
            }
        }
    }
}
