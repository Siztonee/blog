<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string|max:1000'
        ]);

        $comment = Comment::create([
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->user()->id,
            'comment' => $validatedData['content'], 
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }
}
