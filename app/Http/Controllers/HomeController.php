<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Article $article)
    {
        $articles = $article->orderBy('created_at', 'ASC')->paginate(20);
        $lastPage = $articles->lastPage();
        
        if (request()->page === null) {
            return redirect()->route('home', ['page' => $lastPage]);
        }
        
        return view('home', compact('articles'));
    }
}
