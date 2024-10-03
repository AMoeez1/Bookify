<?php

namespace App\Http\Controllers;

use App\Models\Books;
use DB;
use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required|integer',
            'description' => 'required|string',
            'thumbnail' => 'mimes:pdf',
            'file' => 'required|mimes:webp,jpg,jpeg,png',
            'feat_author' => 'email|nullable'
        ]);
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
            $file = $request->file('file')->store('books.pdf', 'public');
            $data['file'] = $file;
        }

        if (isset($data['file'])) {
            $bookCreate = Books::create($data);
            if ($bookCreate) {
                return redirect()->route('profile', )->with('Res', 'Book Published Successfully');
            } else {
                return back()->withErrors(['Error' => 'Error publishing book']);
            }
        }

    }

    public function showBooks($slug)
    {
        $book = Books::where('slug', $slug)->first();
        return view('showBooks', ['book' => $book]);
    }

    public function read($slug)
    {
        $book = Books::where('slug',$slug)->first();

        return view('book', ['book' => $book]);
    }

}
