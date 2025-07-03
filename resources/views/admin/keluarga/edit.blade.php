<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Keluarga: ' . $keluarga->nomor_kk) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <x-input-error :messages="$errors->all()" class="mb-4" />
                    
                    <form action="{{ route('admin.keluarga.update', $keluarga->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- DATA WILAYAH & KEPALA KELUARGA -->
                        <fieldset class="border-2 border-gray-300 dark:border-gray-600 p-4 rounded-lg">
                            <legend class="px-2 font-semibold text-lg">Data Wilayah</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-text-input type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga" class="w-full" required :value="old('nama_kepala_keluarga', $keluarga->nama_kepala_keluarga)" />
                                <x-text-input type="number" name="nomor_kk" placeholder="Nomor KK" class="w-full" required :value="old('nomor_kk', $keluarga->nomor_kk)" />
                                <x-text-input type="text" name="alamat" placeholder="Alamat" class="w-full" required :value="old('alamat', $keluarga->alamat)" />
                                <x-text-input type="number" name="rt" placeholder="RT" class="w-full" required :value="old('rt', $keluarga->rt)" />
                                <x-text-input type="number" name="rw" placeholder="RW" class="w-full" required :value="old('rw', $keluarga->rw)" />
                                <x-text-input type="number" name="kode_pos" placeholder="Kode Pos" class="w-full" :value="old('kode_pos', $keluarga->kode_pos)" />
                                <x-text-input type="text" name="desa_kelurahan" placeholder="Desa/Kelurahan" class="w-full" required :value="old('desa_kelurahan', $keluarga->desa_kelurahan)" />
                                <x-text-input type="text" name="kecamatan" placeholder="Kecamatan" class="w-full" required :value="old('kecamatan', $keluarga->kecamatan)" />
                                <x-text-input type="text" name="kabupaten_kota" placeholder="Kabupaten/Kota" class="w-full" required :value="old('kabupaten_kota', $keluarga->kabupaten_kota)" />
                                <x-text-input type="text" name="provinsi" placeholder="Provinsi" class="w-full" required :value="old('provinsi', $keluarga->provinsi)" />
                            </div>
                        </fieldset>

                        <!-- DATA ANGGOTA KELUARGA (DINAMIS) -->
                        <fieldset class="mt-6 border-2 border-gray-300 dark:border-gray-600 p-4 rounded-lg"
                            x-data="{ 
                                anggota: {{ json_encode(old('anggota', $keluarga->anggota->toArray())) }} 
                            }">
                            <legend class="px-2 font-semibold text-lg">Data Anggota Keluarga</legend>

                            <template x-for="(orang, index) in anggota" :key="index">
                                <div class="border p-4 mb-4 rounded-md relative bg-gray-50 dark:bg-gray-700">
                                    <h3 class="font-bold mb-3 dark:text-gray-200">Anggota ke-<span x-text="index + 1"></span></h3>
                                    <!-- Hidden input untuk ID anggota yang sudah ada -->
                                    <input type="hidden" x-bind:name="`anggota[${index}][id]`" x-model="orang.id">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][nama_lengkap]`" x-model="orang.nama_lengkap" placeholder="Nama Lengkap" required />
                                        <x-text-input type="number" x-bind:name="`anggota[${index}][nik]`" x-model="orang.nik" placeholder="NIK" required />
                                        <x-select x-bind:name="`anggota[${index}][jenis_kelamin]`" x-model="orang.jenis_kelamin" required>
                                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                                            <option value="PEREMPUAN">PEREMPUAN</option>
                                        </x-select>
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][tempat_lahir]`" x-model="orang.tempat_lahir" placeholder="Tempat Lahir" required />
                                        <div><label class="text-sm text-gray-500 dark:text-gray-400">Tanggal Lahir</label><x-text-input type="date" x-bind:name="`anggota[${index}][tanggal_lahir]`" x-model="orang.tanggal_lahir" required /></div>
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][agama]`" x-model="orang.agama" placeholder="Agama" required />
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][pendidikan]`" x-model="orang.pendidikan" placeholder="Pendidikan Terakhir" required />
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][jenis_pekerjaan]`" x-model="orang.jenis_pekerjaan" placeholder="Jenis Pekerjaan" required />
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][golongan_darah]`" x-model="orang.golongan_darah" placeholder="Gol. Darah" />
                                        <x-select x-bind:name="`anggota[${index}][status_perkawinan]`" x-model="orang.status_perkawinan" required><option>BELUM KAWIN</option><option>KAWIN</option><option>CERAI HIDUP</option><option>CERAI MATI</option></x-select>
                                        <div><label class="text-sm text-gray-500 dark:text-gray-400">Tgl Perkawinan</label><x-text-input type="date" x-bind:name="`anggota[${index}][tanggal_perkawinan]`" x-model="orang.tanggal_perkawinan" /></div>
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][status_hubungan_dalam_keluarga]`" x-model="orang.status_hubungan_dalam_keluarga" placeholder="Status Hub. Keluarga" required />
                                        <x-select x-bind:name="`anggota[${index}][kewarganegaraan]`" x-model="orang.kewarganegaraan" required><option>WNI</option><option>WNA</option></x-select>
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][nama_ayah]`" x-model="orang.nama_ayah" placeholder="Nama Ayah" required />
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][nama_ibu]`" x-model="orang.nama_ibu" placeholder="Nama Ibu" required />
                                        <x-text-input type="number" x-bind:name="`anggota[${index}][penghasilan_per_bulan]`" x-model="orang.penghasilan_per_bulan" placeholder="Penghasilan/Bulan (Rp)" />
                                        <x-text-input type="text" x-bind:name="`anggota[${index}][skill_keahlian]`" x-model="orang.skill_keahlian" placeholder="Skill/Keahlian" />
                                        <x-text-input type="email" x-bind:name="`anggota[${index}][email]`" x-model="orang.email" placeholder="Email" />
                                    </div>

                                    <button type="button" @click="anggota.splice(index, 1)" class="absolute top-2 right-2 text-red-500 hover:text-red-700" x-show="anggota.length > 1">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </template>
                            
                            <button type="button" @click="anggota.push({id: null, nama_lengkap: '', nik: '', jenis_kelamin: 'LAKI-LAKI', tempat_lahir: '', tanggal_lahir: '', agama: '', pendidikan: '', jenis_pekerjaan: '', golongan_darah: '', status_perkawinan: 'BELUM KAWIN', tanggal_perkawinan: null, status_hubungan_dalam_keluarga: 'ANAK', kewarganegaraan: 'WNI', nama_ayah: '', nama_ibu: '', penghasilan_per_bulan: null, skill_keahlian: '', email: ''})" class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                + Tambah Anggota Baru
                            </button>
                        </fieldset>

                        <div class="mt-8 flex justify-center">
                            <x-primary-button class="text-lg">
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>