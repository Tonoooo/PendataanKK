<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 mt-1">Anda telah masuk sebagai pengelola. Gunakan menu di bawah untuk mengelola data.</p>
                </div>
            </div>

            <!-- Bagian Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <!-- Statistik Jumlah Keluarga -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 p-4 rounded-full">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Keluarga Terdaftar
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $jumlahKeluarga ?? 0 }}
                            </dd>
                        </div>
                    </div>
                </div>
                <!-- Statistik Jumlah Admin -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex items-center">
                        <div class="flex-shrink-0 bg-green-500 p-4 rounded-full">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-1a6 6 0 00-5.173-5.972" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Akun Pengelola
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $jumlahAdmin ?? 0 }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Navigasi Utama -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Menu Navigasi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Tombol Kelola Data KK -->
                        <a href="{{ route('admin.keluarga.index') }}" class="block p-6 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-lg font-bold text-indigo-800">Kelola Data KK</p>
                                    <p class="mt-1 text-sm text-indigo-600">Lihat, edit, atau hapus data keluarga yang sudah terdaftar.</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Tombol Kelola Admin -->
                        <a href="{{ route('admin.users.index') }}" class="block p-6 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-1a6 6 0 00-5.173-5.972" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-lg font-bold text-green-800">Kelola Admin</p>
                                    <p class="mt-1 text-sm text-green-600">Tambah, edit, atau hapus akun pengelola lainnya.</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>