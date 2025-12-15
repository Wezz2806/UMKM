<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    public $timestamps = true;

    protected $fillable = [
        'nid',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'alamat',
        'dusun',
        'email',
        'ktp_path',
        'kk_path',
        'nominal',
        'norek',
        'pemilik_rekening',
        'bank',
        'nama_usaha',
        'jenis_usaha',
        'tujuan_pendanaan',
        'proposal_path',
        'setuju',
        'status',
        'tgl_pengajuan',
        'tgl_pencairan',
        'tgl_pengembalian',
        'tenor',
        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tgl_pengajuan' => 'date',
        'tgl_pencairan' => 'date',
        'tgl_pengembalian' => 'date',
    ];

    /**
     * Get the user that owns the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}