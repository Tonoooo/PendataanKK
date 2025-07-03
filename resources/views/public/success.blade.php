<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil</title>
    
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
                <p class="px-5 py-2 border border-transparent text-base font-medium rounded-3xl text-green-600 bg-green-200 transition-colors">
                    Berhasil
                </p>
            </div>
        </nav>
    </header>

    <!-- ================================== -->
    <!--      BAGIAN KONTEN SUKSES          -->
    <!-- ================================== -->
    <main class="flex-grow flex items-center justify-center py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto bg-white p-8 sm:p-10 rounded-2xl shadow-lg text-center">

                <!-- Ikon Centang Hijau -->
                <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center bg-green-100 rounded-full">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>

                <!-- Pesan Status dari Controller -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                        {{ session('status') }}
                    </div>
                @endif
                
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Pendaftaran Berhasil!</h1>
                
                <p class="text-gray-600 text-base mb-8">
                    Data KK dengan No. KK <br>
                    <strong class="text-lg text-gray-800 block mt-1">{{ $keluarga->nomor_kk }}</strong> 
                    <br>telah berhasil disimpan dalam sistem.
                </p>

                <!-- Tombol Aksi -->
                <div class="space-y-4">
                    <a href="{{ route('kk.download', $keluarga->id) }}"
                       class="inline-flex items-center justify-center w-full px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg text-lg shadow-md transition-transform transform hover:scale-105">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh KK (PDF)
                    </a>
                    
                    <a href="{{ route('welcome') }}" class="inline-block text-indigo-600 hover:text-indigo-800 hover:underline font-medium">
                        Kembali ke Halaman Utama
                    </a>
                </div>

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