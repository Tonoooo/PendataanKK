<x-guest-layout>
    <div class="text-center p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">Selamat Datang di Sistem Pendataan</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">Silakan isi data keluarga Anda atau masuk sebagai pengelola.</p>

        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <!-- Tombol Buat KK (Lebih Menonjol) -->
            <a href="{{ route('kk.create') }}"
               class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Buat Data KK Baru
            </a>

            <!-- Tombol Login Admin -->
            <a href="{{ route('login') }}"
               class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-lg text-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                Login Admin
            </a>
        </div>
    </div>
</x-guest-layout>