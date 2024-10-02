<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'author_id' => 'required|integer',
        //     'description' => 'required|string',
        //     'thumbnail' => 'mimes:pdf',
        //     'file' => 'required|mimes:webp,jpg,jpeg,png',
        // ]);
        $data = [
            'name' => $request->name,
            'author_id' => Auth::user()->id,
            'author_name' => Auth::user()->name,
            'description' => $request->description,
            'feat_author' => $request->feat,
        ];

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('books.cover', 'public');
            $data['thumbnail'] = $thumbnail;
        }
        if ($request->hasFile('file')) {
            $thumbnail = $request->file('file')->store('books.pdf', 'public');
            $data['file'] = $thumbnail;
        }


        
        if(Books::create($data)){
            return redirect()->route('profile', )->with('Res' , 'Book Published Successfully');
        } else {
            return back()->withErrors(['Error' => 'Error publishing book']);
        }
    }

    // public function FilterBooks(){
    //     $author = Auth::user()->id;
    //     $books = Books::where('author_id', $author)->get();
    //     // session(['books' => $books]);
    //     return view('profile')->with('books', $books);
    // }
}
