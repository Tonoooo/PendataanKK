<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kartu Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KK</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kepala Keluarga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jml Anggota</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($PendataanKK as $kk)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $kk->nomor_kk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $kk->nama_kepala_keluarga }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($kk->alamat, 30) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $kk->anggota_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('kk.download', $kk->id) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat/Unduh</a>
                                            <a href="{{ route('admin.keluarga.edit', $kk->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Edit</a>
                                            <form action="{{ route('admin.keluarga.destroy', $kk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $PendataanKK->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>