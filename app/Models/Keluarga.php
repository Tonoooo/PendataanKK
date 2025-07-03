<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keluarga extends Model
{
    protected $fillable = [
        'nomor_kk',
        'nama_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'tanggal_dikeluarkan',
    ];
    
    // Definisikan relasi ke AnggotaKeluarga
    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }
}
