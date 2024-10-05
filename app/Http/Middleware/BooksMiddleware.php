<?php

namespace App\Http\Middleware;

use App\Models\Books;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BooksMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');

        $user = auth()->user();
        if(!$user){
            return redirect()->route('home')->with('Res', 'Prohibited Route Access');
        }
        $book = Books::where('slug', $slug)->first();
        if(!$book){
            return redirect()->route('home')->with('Res', 'Prohibited Route Access');

        }

        if($book->author_id === null){
            return redirect()->route('home')->with('Res', 'Prohibited Route Access');
        
        }

        if( $book->author_id == $user->id){
            return $next($request);
        }

        return redirect()->route('home')->with('Res', 'Prohibited Route Access');
    
    }
}
