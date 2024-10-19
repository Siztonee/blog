<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index($slug, Article $article, Like $like, Comment $comment)
    {
        $selectedArticle = $article->where('slug', $slug)->first();

        $likes = $like->where('article_id', $selectedArticle->id)->count();

        $isLiked = $like->where('user_id', auth()->id())
                   ->where('article_id', $selectedArticle->id)
                   ->exists();

        $comments = $comment->where('article_id', $selectedArticle->id)->orderBy('created_at', 'ASC')->paginate(5);

        return view('article', compact('selectedArticle', 'likes', 'isLiked', 'comments'));
    }
}
