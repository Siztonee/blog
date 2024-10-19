@extends('layouts.app')

@section('title') Авторизация @endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-sm w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-gray-900">
                Войти в аккаунт
            </h2>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="login" class="sr-only">Логин</label>
                    <input id="login" name="login" type="text" autocomplete="login" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Логин">
                </div>
                <div>
                    <label for="password" class="sr-only">Пароль</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Пароль">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Запомнить меня
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Войти
                </button>
            </div>
        </form>
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Нет аккаунта?
                <a href="{{ route('register') }}" class="font-medium text-purple-600 hover:text-purple-500">
                    Зарегистрироваться
                </a>
            </p>
        </div>
    </div>
</div>
@endsection