<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Mail\AuthorVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::inRandomOrder()->limit(5)->get();
        return view("pages.home", ['books' => $books]);
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

        return view('pages.profile',)->with('books', $books);
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

    public function allUser($id){
        $user = User::where('id',$id)->first();
        $logged_user = Auth::id();
        if(!$user){
            return redirect()->route('home')->with('Res', 'No User Found');
        }
        $books = Books::where('author_id', $user->id)->get();
        if($user->id == $logged_user){
            return redirect()->route('profile');

        } else {
            return view('pages.other_profile',['user'=> $user, 'books' => $books]);
        }
    }

    public function author(){
        $users = User::where('role','author')->inRandomOrder()->get();
        return view('pages.author',['users' => $users]);
    }

    public function sendMail(){
        $messageContent = 'Email Verification to Bookify';
        $subject = 'Bookify Author Verification Service';
        $toUser = auth()->user()->email;

        $mail = Mail::to($toUser)->send(new AuthorVerify($subject,$messageContent ));
        if($mail){
            return redirect()->route('profile')->with('Res' , 'Verification email sent');
        } else {
            return redirect()->back()->withErrors(['Error' => 'Error Sending mail']);
        }
    }

    public function verifyAuthor(){
        $userId = auth::id();
        $author = User::find($userId);
        if(!$userId){
            return back()->withErrors(['Error' => 'No Author Found']);
        }
        if($author){
            $author->email_verified_at = now();
            $author->save();
            return redirect()->route('profile')->with('Res', 'Verified Successfully');
        } else {
            return back()->withErrors(['Error' => 'No Author Found']);
        }
    }
}