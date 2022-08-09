{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="form-wrapp">
        <form class="login-form" method="POST" action="{{ route('login') }}">

            @csrf
            <div class="login-img">
            <img  src="{{ asset('img/logo.png') }}" alt="" srcset="">
            </div>
            <div>
                <label class="login-label" class="login" for="name">Ім'я</label>
                <input class="login-input" type="text" id="name" name="name" value="{{ old('name') }}"  required autofocus>
                {{-- <x-input class="login-input" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> --}}
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="login-label" class="login" for="password">Пароль</label>
                <input class="login-input" type="password" id="password" name="password" value="{{ old('name') }}"  required autocomplete="current-password">
            </div>

            <!-- Remember Me -->
            <div class="login-btn-check">
            <button type="submit" class="login-btn">Увійти</button>
            <div class="block mt-4">
                <label for="remember_me" class="login-check">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span>Запам'ятати мене</span>
                </label>
            </div>

            </div>
        </form>
    </div>
    {{-- </x-auth-card>
</x-guest-layout> --}}
