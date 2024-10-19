<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function __invoke(Request $request)
    {
        $articleId = $request->input('article_id');
        $article = Article::findOrFail($articleId);
        
        $like = Like::where('user_id', auth()->id())
                    ->where('article_id', $articleId)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'article_id' => $articleId
            ]);
        }

        $likesCount = Like::where('article_id', $articleId)->count();

        $isLiked = Like::where('user_id', auth()->id())
                   ->where('article_id', $articleId)
                   ->exists();

        return response()->json([
            'success' => true,
            'likes' => $likesCount,
            'isLiked' => $isLiked
        ]);
    }
}
