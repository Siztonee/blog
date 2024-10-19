<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Article $article)
    {
        return view('home', [
            'articles' => $article->all()
        ]);
    }
}
