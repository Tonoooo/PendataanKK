<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PDF; // Nama alias dari barryvdh/laravel-dompdf

class PublicKkController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function create()
    {
        // Kita akan membuat view form ini di langkah selanjutnya
        return view('public.form_kk');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validasi Data Keluarga
            'nama_kepala_keluarga' => 'required|string|max:255',
            'nomor_kk' => 'required|digits:16|unique:keluargas,nomor_kk',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kode_pos' => 'nullable|digits:5',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',

            // Validasi Data Anggota (Array)
            'anggota' => 'required|array|min:1',
            'anggota.*.nama_lengkap' => 'required|string|max:255',
            'anggota.*.nik' => 'required|digits:16|distinct|unique:anggota_keluargas,nik',
            'anggota.*.jenis_kelamin' => ['required', Rule::in(['LAKI-LAKI', 'PEREMPUAN'])],
            'anggota.*.tempat_lahir' => 'required|string|max:100',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.agama' => 'required|string|max:50',
            'anggota.*.pendidikan' => 'required|string|max:100',
            'anggota.*.jenis_pekerjaan' => 'required|string|max:100',
            'anggota.*.golongan_darah' => 'nullable|string|max:3',
            'anggota.*.status_perkawinan' => 'required|string',
            'anggota.*.tanggal_perkawinan' => 'nullable|date',
            'anggota.*.status_hubungan_dalam_keluarga' => 'required|string|max:100',
            'anggota.*.kewarganegaraan' => 'required|string',
            'anggota.*.nama_ayah' => 'required|string|max:255',
            'anggota.*.nama_ibu' => 'required|string|max:255',
            'anggota.*.penghasilan_per_bulan' => 'nullable|numeric|min:0',
            'anggota.*.skill_keahlian' => 'nullable|string',
            'anggota.*.email' => 'nullable|email|distinct|unique:anggota_keluargas,email',
        ]);

        try {
            DB::beginTransaction();

            $keluarga = Keluarga::create([
                'nomor_kk' => $validated['nomor_kk'],
                'nama_kepala_keluarga' => $validated['nama_kepala_keluarga'],
                'alamat' => $validated['alamat'],
                'rt' => $validated['rt'],
                'rw' => $validated['rw'],
                'kode_pos' => $validated['kode_pos'],
                'desa_kelurahan' => $validated['desa_kelurahan'],
                'kecamatan' => $validated['kecamatan'],
                'kabupaten_kota' => $validated['kabupaten_kota'],
                'provinsi' => $validated['provinsi'],
                'tanggal_dikeluarkan' => now(),
            ]);

            foreach ($validated['anggota'] as $dataAnggota) {
                // Tambahkan 'keluarga_id' sebelum create
                $dataAnggota['keluarga_id'] = $keluarga->id;
                AnggotaKeluarga::create($dataAnggota);
            }

            DB::commit();

            return redirect()->route('kk.success', ['keluarga' => $keluarga->id])
                             ->with('status', 'Data keluarga berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Redirect kembali dengan error dan input lama
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }

    }

    public function success(Keluarga $keluarga)
    {
        return view('public.success', compact('keluarga'));
    }

    public function downloadPdf(Keluarga $keluarga)
    {
         // Eager load relasi anggota agar tidak terjadi N+1 query
         $keluarga->load('anggota');
        
         // Load view PDF dengan data
         $pdf = PDF::loadView('pdf.kartu_keluarga', compact('keluarga'));
         
         // Set ukuran kertas menjadi Legal (mirip F4) dan orientasi landscape
         $pdf->setPaper('legal', 'landscape');
         
         // Tampilkan PDF di browser atau unduh langsung
         // return $pdf->stream('KK-'.$keluarga->nomor_kk.'.pdf'); // Tampilkan di browser
         return $pdf->download('KK-'.$keluarga->nomor_kk.'.pdf'); // Langsung unduh
    }
}
