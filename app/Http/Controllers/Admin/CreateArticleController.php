<?php

namespace App\Http\Controllers\Admin;

use HTMLPurifier;
use App\Models\Article;
use HTMLPurifier_Config;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;

class CreateArticleController extends Controller
{
    public function index()
    {
        return view('admin.create-article');
    }

    public function store(CreateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,strong,i,em,u,a[href],ul,ol,li');
        $purifier = new HTMLPurifier($config);
        $cleanContent = $purifier->purify($data['description']);

        $imagePath = $request->file('image')->store('images', 'public'); 
        $imageName = basename($imagePath);

        $article->create([
            'creator_id' => auth()->user()->id,
            'title' => $data['title'],
            'image' => $imageName,
            'description' => $cleanContent,
            'slug' => Article::createUniqueSlug($data['title'])
        ]);

        return redirect()->back()->with('success', 'Статья успешно сохранена');
    }
}



