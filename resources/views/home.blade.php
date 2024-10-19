@extends('layouts.app')

@section('title') Главная @endsection

@section('content')
<main class="container mx-auto mt-8 px-4">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3">

            @forelse ($articles as $article)
                <article class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 mb-4">Опубликовано: {{ $article->created_at->diffForHumans() }}</p>
                    <img src="{{ asset('storage/images/' . $article->image) }}" alt="Изображение статьи" class="w-full h-auto mb-4 rounded">
                    <p class="text-gray-800">{!! Str::limit($article->description, 210, '...') !!}</p>
                    <a href="{{ route('article', $article->slug) }}" class="inline-block mt-4 bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-300 ease-in-out">Читать далее</a>
                </article>
            @empty
                <p>Пусто</p>
            @endforelse

        </div>
    </div>
</main>
@endsection
 
