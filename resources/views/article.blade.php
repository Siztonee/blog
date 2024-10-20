@extends('layouts.app')

@section('title') {{ $selectedArticle->title }} @endsection

@section('content')
<article class="bg-white shadow-lg rounded-lg overflow-hidden">
    <header class="p-6 sm:p-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ $selectedArticle->title }}</h1>
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">{{ $selectedArticle->created_at->format('d M, Y') }}</span>
            <button id="likeButton" class="flex items-center space-x-2 hover:text-red-600" data-article-id="{{ $selectedArticle->id }}" data-is-liked="{{ $isLiked ? 'true' : 'false' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                    <path id="heartPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span id="likeCount" class="font-medium">{{ $likes }}</span>
            </button>
        </div>
    </header>

    <figure class="relative">
        <img src="{{ asset('storage/images/' . $selectedArticle->image) }}" alt="{{ $selectedArticle->title }}" class="w-full h-64 sm:h-96 object-cover">
    </figure>

    <div class="p-6 sm:p-8">
        <div class="prose max-w-none">
            {!! $selectedArticle->description !!}
        </div>
    </div>
</article>

<section class="mt-12 space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Комментарии</h2>
    @forelse ($comments as $comment)
        <div class="bg-white shadow-md rounded-lg p-6 transition duration-300 ease-in-out hover:shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr($comment->user->login, 0, 1)) }}
                    </div>
                    <h3 class="font-medium text-gray-900">{{ $comment->user->login }}</h3>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <p class="text-gray-700 leading-relaxed">{{ $comment->comment }}</p>
        </div>
    @empty
        <div class="bg-white shadow rounded-lg p-6 mb-4">
            <p>Комментариев пока нет.</p>
        </div>
    @endforelse

    {{ $comments->links() }}
        
    <form id="comment-form">
        @csrf
        <input type="hidden" name="article_id" value="{{ $selectedArticle->id }}">
        <textarea name="content" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Оставьте свой комментарий..."></textarea>
        <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Отправить комментарий</button>
    </form>

</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/like-ajax.js') }}"></script>
    <script src="{{ asset('js/comment-ajax.js?v=2.0.8') }}"></script>
@endpush