<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pembuatan KK</title>

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
                {{-- <a href="{{ route('login') }}" class="px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    Login Pengelola
                </a> --}}
            </div>
        </nav>
    </header>

    <!-- ================================== -->
    <!--      BAGIAN KONTEN FORMULIR        -->
    <!-- ================================== -->
    <main class="flex-grow py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-2xl shadow-lg">

                <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">Formulir Pembuatan KK</h1>
                <p class="text-center text-gray-500 mb-8">Mohon isi semua data dengan benar dan lengkap.</p>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                        <p class="font-bold">Terjadi Kesalahan</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('kk.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- BAGIAN 1: DATA KEPALA KELUARGA & ALAMAT -->
                    <fieldset class="space-y-4 border-t pt-6">
                        <legend class="text-xl font-semibold text-gray-800">Data Wilayah & Kepala Keluarga</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                            <div class="sm:col-span-2"><x-input-label for="nama_kepala_keluarga" value="Nama Kepala Keluarga" /><x-text-input id="nama_kepala_keluarga" name="nama_kepala_keluarga" type="text" class="mt-1 block w-full" :value="old('nama_kepala_keluarga')" required /></div>
                            <div><x-input-label for="nomor_kk" value="Nomor KK (16 Digit)" /><x-text-input id="nomor_kk" name="nomor_kk" type="number" class="mt-1 block w-full" :value="old('nomor_kk')" required /></div>
                            <div class="sm:col-span-2"><x-input-label for="alamat" value="Alamat" /><x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat')" required /></div>
                            <div><x-input-label for="rt" value="RT" /><x-text-input id="rt" name="rt" type="number" class="mt-1 block w-full" :value="old('rt')" required /></div>
                            <div><x-input-label for="rw" value="RW" /><x-text-input id="rw" name="rw" type="number" class="mt-1 block w-full" :value="old('rw')" required /></div>
                            <div><x-input-label for="kode_pos" value="Kode Pos" /><x-text-input id="kode_pos" name="kode_pos" type="number" class="mt-1 block w-full" :value="old('kode_pos')" /></div>
                            <div><x-input-label for="desa_kelurahan" value="Desa / Kelurahan" /><x-text-input id="desa_kelurahan" name="desa_kelurahan" type="text" class="mt-1 block w-full" :value="old('desa_kelurahan')" required /></div>
                            <div><x-input-label for="kecamatan" value="Kecamatan" /><x-text-input id="kecamatan" name="kecamatan" type="text" class="mt-1 block w-full" :value="old('kecamatan')" required /></div>
                            <div><x-input-label for="kabupaten_kota" value="Kabupaten / Kota" /><x-text-input id="kabupaten_kota" name="kabupaten_kota" type="text" class="mt-1 block w-full" :value="old('kabupaten_kota')" required /></div>
                            <div><x-input-label for="provinsi" value="Provinsi" /><x-text-input id="provinsi" name="provinsi" type="text" class="mt-1 block w-full" :value="old('provinsi')" required /></div>
                        </div>
                    </fieldset>

                    <!-- BAGIAN 2: DATA ANGGOTA KELUARGA -->
                    <fieldset class="space-y-4 border-t pt-6" x-data="{ anggota: {{ json_encode(old('anggota', [['status_hubungan_dalam_keluarga' => 'KEPALA KELUARGA', 'jenis_kelamin' => 'LAKI-LAKI', 'status_perkawinan' => 'BELUM KAWIN', 'kewarganegaraan' => 'WNI']])) }} }">
                        <legend class="text-xl font-semibold text-gray-800">Data Anggota Keluarga</legend>
                        <div class="space-y-6">
                            <template x-for="(orang, index) in anggota" :key="index">
                                <div class="border border-gray-200 p-4 rounded-lg relative space-y-4 bg-gray-50/50">
                                    <div class="flex justify-between items-center"><h3 class="font-semibold text-gray-700">Anggota Keluarga ke-<span x-text="index + 1"></span></h3><button type="button" @click="anggota.splice(index, 1)" x-show="anggota.length > 1" class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button></div>
                                    
                                    {{-- Kita akan menggunakan tag HTML standar untuk input yang dinamis agar tidak ada konflik dengan Blade --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                                        
                                        <div class="lg:col-span-3">
                                            <label x-bind:for="`anggota_nama_${index}`" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                                            <input x-bind:id="`anggota_nama_${index}`" x-bind:name="`anggota[${index}][nama_lengkap]`" type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full" x-model="orang.nama_lengkap" required>
                                        </div>
                    
                                        <div>
                                            <label x-bind:for="`anggota_nik_${index}`" class="block font-medium text-sm text-gray-700">NIK</label>
                                            <input x-bind:id="`anggota_nik_${index}`" x-bind:name="`anggota[${index}][nik]`" type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full" x-model="orang.nik" required>
                                        </div>
                    
                                        <div>
                                            <label x-bind:for="`anggota_jk_${index}`" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                                            <select x-bind:id="`anggota_jk_${index}`" x-bind:name="`anggota[${index}][jenis_kelamin]`" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full" x-model="orang.jenis_kelamin" required>
                                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                <option value="PEREMPUAN">PEREMPUAN</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label x-bind:for="`anggota_hubungan_${index}`" class="block font-medium text-sm text-gray-700">Status Hub. Keluarga</label>
                                            <input x-bind:id="`anggota_hubungan_${index}`" x-bind:name="`anggota[${index}][status_hubungan_dalam_keluarga]`" type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full" x-model="orang.status_hubungan_dalam_keluarga" required>
                                        </div>
                    
                                        {{-- Menggunakan tag HTML standar untuk semua input dinamis --}}
                                        <div><label class="block font-medium text-sm text-gray-700">Tempat Lahir</label><input x-bind:name="`anggota[${index}][tempat_lahir]`" type="text" x-model="orang.tempat_lahir" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Tanggal Lahir</label><input x-bind:name="`anggota[${index}][tanggal_lahir]`" type="date" x-model="orang.tanggal_lahir" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Agama</label><input x-bind:name="`anggota[${index}][agama]`" type="text" x-model="orang.agama" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Pendidikan Terakhir</label><input x-bind:name="`anggota[${index}][pendidikan]`" type="text" x-model="orang.pendidikan" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Jenis Pekerjaan</label><input x-bind:name="`anggota[${index}][jenis_pekerjaan]`" type="text" x-model="orang.jenis_pekerjaan" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Golongan Darah</label><input x-bind:name="`anggota[${index}][golongan_darah]`" type="text" x-model="orang.golongan_darah" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Status Perkawinan</label>
                                            <select x-bind:name="`anggota[${index}][status_perkawinan]`" x-model="orang.status_perkawinan" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"><option>BELUM KAWIN</option><option>KAWIN</option><option>CERAI HIDUP</option><option>CERAI MATI</option></select>
                                        </div>
                                        <div><label class="block font-medium text-sm text-gray-700">Tgl. Perkawinan</label><input x-bind:name="`anggota[${index}][tanggal_perkawinan]`" type="date" x-model="orang.tanggal_perkawinan" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Kewarganegaraan</label>
                                            <select x-bind:name="`anggota[${index}][kewarganegaraan]`" x-model="orang.kewarganegaraan" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"><option>WNI</option><option>WNA</option></select>
                                        </div>
                                        <div><label class="block font-medium text-sm text-gray-700">Nama Ayah</label><input x-bind:name="`anggota[${index}][nama_ayah]`" type="text" x-model="orang.nama_ayah" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Nama Ibu</label><input x-bind:name="`anggota[${index}][nama_ibu]`" type="text" x-model="orang.nama_ibu" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div class="lg:col-span-3"><hr></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Email (Opsional)</label><input x-bind:name="`anggota[${index}][email]`" type="email" x-model="orang.email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Penghasilan/Bulan (Rp)</label><input x-bind:name="`anggota[${index}][penghasilan_per_bulan]`" type="number" x-model="orang.penghasilan_per_bulan" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                        <div><label class="block font-medium text-sm text-gray-700">Skill/Keahlian</label><input x-bind:name="`anggota[${index}][skill_keahlian]`" type="text" x-model="orang.skill_keahlian" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <button type="button" @click="anggota.push({nama_lengkap: '', nik: '', jenis_kelamin: 'LAKI-LAKI', tempat_lahir: '', tanggal_lahir: '', agama: '', pendidikan: '', jenis_pekerjaan: '', golongan_darah: '', status_perkawinan: 'BELUM KAWIN', tanggal_perkawinan: '', status_hubungan_dalam_keluarga: 'ANAK', kewarganegaraan: 'WNI', nama_ayah: '', nama_ibu: '', penghasilan_per_bulan: '', skill_keahlian: '', email: ''})" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md"><svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Tambah Anggota</button>
                    </fieldset>

                    <div class="flex justify-end pt-6 border-t">
                        <x-primary-button class="text-lg px-8 py-3">Kirim Data & Buat KK</x-primary-button>
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
            <p class="text-center text-sm text-gray-500">© {{ date('Y') }} PendataanKK. All rights reserved.</p>
        </div>
    </footer>

</div>
</body>
</html>