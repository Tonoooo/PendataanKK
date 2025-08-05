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
        // cek apakah request hanya punya 1 bari data (kepala keluarga) saja atau memiliki anggota keluarga
        // jika hanya kepala keluarga maka kita akan simpan data keluarga saja
        if ($request->has('anggota') && count($request->input('anggota')) == 0) {
            // simpan data keluarga saja
            $validated = $request->validate([
                // Validasi Data Keluarga
                'nama_kepala_keluarga' => 'required|string|max:255',
                'nomor_kk' => 'required|digits:16|unique:keluargas,nomor_kk',
                'alamat' => 'required|string|max:255',

            ]);

            // Tambahkan tanggal_dikeluarkan sebelum menyimpan
            $validated['tanggal_dikeluarkan'] = now()->toDateString();

            // simpan data keluarga
            $keluarga = Keluarga::create($validated);
            

            return redirect()->route('kk.success', ['keluarga' => $keluarga->id])
                             ->with('status', 'Data keluarga berhasil dibuat!');

        } else {
            // simpan data keluarga dan anggota keluarga
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
            'anggota' => 'nullable|array',
            'anggota.*.nama_lengkap' => 'nullable|string|max:255',
            'anggota.*.nik' => 'nullable|digits:16|distinct|unique:anggota_keluargas,nik',
            'anggota.*.jenis_kelamin' => ['nullable', Rule::in(['LAKI-LAKI', 'PEREMPUAN'])],
            'anggota.*.tempat_lahir' => 'nullable|string|max:100',
            'anggota.*.tanggal_lahir' => 'nullable|date',
            'anggota.*.agama' => 'nullable|string|max:50',
            'anggota.*.pendidikan' => 'nullable|string|max:100',
            'anggota.*.jenis_pekerjaan' => 'nullable|string|max:100',
            'anggota.*.golongan_darah' => 'nullable|string|max:3',
            'anggota.*.status_perkawinan' => 'nullable|string',
            'anggota.*.tanggal_perkawinan' => 'nullable|date',
            'anggota.*.status_hubungan_dalam_keluarga' => 'nullable|string|max:100',
            'anggota.*.kewarganegaraan' => 'nullable|string',
            'anggota.*.nama_ayah' => 'nullable|string|max:255',
            'anggota.*.nama_ibu' => 'nullable|string|max:255',
            'anggota.*.penghasilan_per_bulan' => 'nullable|numeric|min:0',
            'anggota.*.skill_keahlian' => 'nullable|string',
            'anggota.*.email' => 'nullable|email|distinct|unique:anggota_keluargas,email',
            ]);

            // Tambahkan tanggal_dikeluarkan sebelum menyimpan
            $validated['tanggal_dikeluarkan'] = now()->toDateString();

            // simpan data keluarga
            $keluarga = Keluarga::create($validated);

            // simpan data anggota keluarga
            foreach ($validated['anggota'] as $anggota) {
                $anggota['keluarga_id'] = $keluarga->id;
                AnggotaKeluarga::create($anggota);  
            }

            return redirect()->route('kk.success', ['keluarga' => $keluarga->id])
                             ->with('status', 'Data keluarga berhasil dibuat!');
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
