<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pendataan Keluarga</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
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
                    
                    <!-- Logo di Kiri -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                            <svg class="h-8 w-auto text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.5-2.962a3.75 3.75 0 0 1-4.29-4.29 3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1 4.29 4.29 3.75 3.75 0 0 1-4.29 4.29m0 0a3.75 3.75 0 0 1-4.29 4.29 3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1 4.29 4.29m0 0a3.75 3.75 0 0 1 4.29 4.29 3.75 3.75 0 0 1-4.29-4.29m-10.5-4.29a3.75 3.75 0 0 1 4.29-4.29 3.75 3.75 0 0 1-4.29 4.29m0 0a3.75 3.75 0 0 1-4.29-4.29 3.75 3.75 0 0 1 4.29 4.29" />
                            </svg>
                            <span class="font-bold text-xl text-gray-800">PendataanKK</span>
                        </a>
                    </div>
                    
                    <!-- Tombol Login di Kanan -->
                    <div>
                        <a href="{{ route('login') }}" class="px-5 py-2 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                            Login
                        </a>
                    </div>

                </div>
            </nav>
        </header>

        <!-- ================================== -->
        <!--      BAGIAN KONTEN UTAMA (HERO)    -->
        <!-- ================================== -->
        <main class="flex-grow">
            <div class="relative overflow-hidden">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative py-24 sm:py-32 lg:py-40">
                        
                        <div class="max-w-3xl mx-auto text-center">
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900">
                                Mari Membuat KK Anda, <span class="text-indigo-600">Dengan Mudah dan Cepat.</span>
                            </h1>
                            <p class="mt-6 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                                Platform terpusat untuk mendata, mengelola, dan menghasilkan dokumen KK untuk anggota komunitas secara efisien dan aman.
                            </p>
                            
                            {{-- Tombol Call-to-Action Utama --}}
                            <div class="mt-10">
                                <a href="{{ route('kk.create') }}" 
                                   class="inline-block w-full sm:w-auto px-10 py-4 border border-transparent text-lg font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg transform transition-transform hover:scale-105">
                                    Buat KK Baru
                                </a>
                            </div>
                        </div>
                        
                        {{-- Elemen dekoratif (opsional, tapi membuat tampilan lebih hidup) --}}
                        <div class="absolute top-0 right-0 -mr-48 -mt-24 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-40 animate-blob"></div>
                        <div class="absolute bottom-0 left-0 -ml-48 -mb-24 w-80 h-80 bg-cyan-200 rounded-full mix-blend-multiply filter blur-xl opacity-40 animate-blob animation-delay-4000"></div>

                    </div>
                </div>
            </div>
        </main>
        
        <!-- ================================== -->
        <!--            BAGIAN FOOTER           -->
        <!-- ================================== -->
        <footer class="bg-white border-t border-gray-200">
            <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    © {{ date('Y') }} PendataanKK. All rights reserved.
                </p>
            </div>
        </footer>

    </div>
</body>
</html>