<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengelola</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

<div class="flex flex-col min-h-screen">

    <!-- ================================== -->
    <!--      BAGIAN TOP NAVBAR            -->
    <!-- ================================== -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-auto text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.5-2.962a3.75 3.75 0 0 1-4.29-4.29 3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1 4.29 4.29 3.75 3.75 0 0 1-4.29 4.29m0 0a3.75 3.75 0 0 1-4.29 4.29 3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1 4.29 4.29m0 0a3.75 3.75 0 0 1 4.29 4.29 3.75 3.75 0 0 1-4.29-4.29m-10.5-4.29a3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1-4.29 4.29m0 0a3.75 3.75 0 0 1-4.29-4.29 3.75 3.75 0 0 1 4.29 4.29" />
                    </svg>
                    <span class="font-bold text-xl text-gray-800">PendataanKK</span>
                </a>
                {{-- Tombol login di navbar tidak terlalu relevan di halaman login itu sendiri, tapi kita biarkan untuk konsistensi --}}
                 <a href="{{ route('login') }}" class="px-5 py-2 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    Login Pengelola
                </a>
            </div>
        </nav>
    </header>

    <!-- ================================== -->
    <!--      BAGIAN KONTEN LOGIN           -->
    <!-- ================================== -->
    <main class="flex-grow flex items-center justify-center py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto bg-white p-8 sm:p-10 rounded-2xl shadow-lg">
                
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Login Pengelola</h1>
                    <p class="text-gray-500 mt-2">Selamat datang kembali!</p>
                </div>

                <!-- Session Status (misal: setelah reset password) -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-4 px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <!-- ================================== -->
    <!--            BAGIAN FOOTER           -->
    <!-- ================================== -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                © {{ date('Y') }} PendataanKK. All rights reserved.
            </p>
        </div>
    </footer>

</div>
</body>
</html>