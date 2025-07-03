<x-guest-layout>
    <div class="text-center p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <!-- Menampilkan pesan status dari redirect -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center bg-green-100 rounded-full">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">Data Berhasil Disimpan!</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">Data Keluarga dengan No. KK: <strong>{{ $keluarga->nomor_kk }}</strong> telah berhasil didaftarkan.</p>

        <div class="space-y-4">
             <a href="{{ route('kk.download', $keluarga->id) }}"
               class="inline-block w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg text-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Unduh KK (PDF)
            </a>
            <a href="{{ route('welcome') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Kembali ke Halaman Utama</a>
        </div>
    </div>
</x-guest-layout>