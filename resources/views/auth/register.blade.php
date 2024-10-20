@extends('layouts.app')

@section('title') Регистрация @endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-sm w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Создать новый аккаунт
            </h2>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
        
        <form id="registration-form" class="mt-8 space-y-6" action="{{ route('register.store') }}" method="POST" onsubmit="return validatePasswords();">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="login" class="sr-only">Логин</label>
                    <input id="login" name="login" type="text" autocomplete="login" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Логин">
                </div>
                <div>
                    <label for="email" class="sr-only">Email адрес</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Email адрес">
                </div>
                <div>
                    <label for="password" class="sr-only">Пароль</label>
                    <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Пароль">
                </div>
                <div>
                    <label for="password_confirm" class="sr-only">Подтвердите пароль</label>
                    <input id="password_confirm" name="password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Подтвердите пароль">
                </div>
                <div id="error-message" class="text-red-500 mt-2 hidden">Пароли не совпадают!</div>
            </div>
        
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Зарегистрироваться
                </button>
            </div>
        </form>
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Уже есть аккаунт?
                <a href="{{ route('auth') }}" class="font-medium text-purple-600 hover:text-purple-500">
                    Войти
                </a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/password.js') }}"></script>
@endpush