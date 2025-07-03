<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data KK dan tampilkan di tabel admin
        $PendataanKK = Keluarga::withCount('anggota')->latest()->paginate(15);
        return view('admin.keluarga.index', compact('PendataanKK'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keluarga $keluarga)
    {
        return redirect()->route('kk.download', $keluarga);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluarga $keluarga)
    {
        $keluarga->load('anggota');
        // Tampilkan form edit (mirip form create publik, tapi diisi data yang sudah ada)
        return view('admin.keluarga.edit', compact('keluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        // Validasi data utama keluarga
        $validatedKeluarga = $request->validate([
            'nama_kepala_keluarga' => 'required|string|max:255',
            'nomor_kk' => ['required', 'digits:16', Rule::unique('keluargas')->ignore($keluarga->id)],
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kode_pos' => 'nullable|digits:5',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);

        // Validasi data anggota
        $validatedAnggota = $request->validate([
            'anggota' => 'required|array|min:1',
            'anggota.*.id' => 'nullable|exists:anggota_keluargas,id',
            'anggota.*.nama_lengkap' => 'required|string|max:255',
            // Validasi NIK unik, abaikan NIK anggota yang sedang diedit
            'anggota.*.nik' => ['required', 'digits:16', function ($attribute, $value, $fail) use ($request) {
                $index = explode('.', $attribute)[1];
                $id = $request->input("anggota.$index.id");
                $isUnique = AnggotaKeluarga::where('nik', $value)->where('id', '!=', $id)->doesntExist();
                if (!$isUnique) {
                    $fail("NIK {$value} sudah terdaftar.");
                }
            }],
            // Tambahkan validasi lain untuk anggota seperti di method store...
            'anggota.*.email' => ['nullable', 'email', function ($attribute, $value, $fail) use ($request) {
                $index = explode('.', $attribute)[1];
                $id = $request->input("anggota.$index.id");
                $isUnique = AnggotaKeluarga::where('email', $value)->where('id', '!=', $id)->doesntExist();
                if (!empty($value) && !$isUnique) {
                    $fail("Email {$value} sudah terdaftar.");
                }
            }],
        ]);

        try {
            DB::beginTransaction();

            // 1. Update data utama keluarga
            $keluarga->update($validatedKeluarga);

            $submittedAnggotaIds = [];

            // 2. Update atau Create anggota
            foreach ($validatedAnggota['anggota'] as $dataAnggota) {
                if (!empty($dataAnggota['id'])) {
                    // Ini adalah anggota yang sudah ada, lakukan update
                    $anggota = AnggotaKeluarga::find($dataAnggota['id']);
                    if ($anggota) {
                        $anggota->update($dataAnggota);
                        $submittedAnggotaIds[] = $anggota->id;
                    }
                } else {
                    // Ini adalah anggota baru, lakukan create
                    $newAnggota = $keluarga->anggota()->create($dataAnggota);
                    $submittedAnggotaIds[] = $newAnggota->id;
                }
            }

            // 3. Hapus anggota yang tidak ada di form submission
            $keluarga->anggota()->whereNotIn('id', $submittedAnggotaIds)->delete();

            DB::commit();

            return redirect()->route('admin.keluarga.index')->with('status', 'Data KK berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('admin.keluarga.index')->with('status', 'Data KK berhasil dihapus.');
    }
}
