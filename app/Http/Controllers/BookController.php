<?php

namespace App\Http\Controllers;

use App\Models\Books;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'thumbnail' => 'required|mimes:webp,jpg,jpeg,png',
            'file' => 'required|mimes:pdf',
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
        $book = Books::where('slug', $slug)->first();

        return view('book', ['book' => $book]);
    }

    public function showEdit($slug)
    {
        $book = Books::where('slug', $slug)->first();
        $user = Auth::user();
        return view('editBook', ['book' => $book]);
    }

    public function editBook(Request $request, $slug)
    {
        // dd($request);
        $book = Books::where('slug', $slug)->first();
        if ($book) {
            $book->name = $request->input('name');
            $book->feat_author = $request->input('feat_author');
            $book->description = $request->input('description');
            if ($request->hasFile('file')) {
                if($book->file){
                    Storage::disk('public')->delete($book->file);
                }
                $book->file = $request->file('file')->store('books.pdf', 'public');
            }
            if($request->hasFile('thumbnail')){
                if($book->thumbnail){
                    Storage::disk('public')->delete($book->thumbnail);
                }
                $book->thumbnail = $request->file('thumbnail')->store('books.cover', 'public');
            }
            $book->save();
            return redirect()->route('profile')->with('Res', 'Book Edited Successfully');
        }
    }

}
