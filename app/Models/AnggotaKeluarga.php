<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    protected $fillable = [
        'keluarga_id', // Penting untuk relasi
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'jenis_pekerjaan',
        'golongan_darah',
        'status_perkawinan',
        'tanggal_perkawinan',
        'status_hubungan_dalam_keluarga',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'penghasilan_per_bulan',
        'skill_keahlian',
        'email',
    ];
    
    // Definisikan relasi balik ke Keluarga
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }
}
