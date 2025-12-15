<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- PASTIKAN BARIS INI ADA
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- PASTIKAN HasFactory DIGUNAKAN DI SINI

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan role juga ada di sini jika Anda mengisinya melalui factory atau create
        // 'address', // tambahkan kembali jika memang ada dan digunakan
        // 'idNumber', // tambahkan kembali jika memang ada dan digunakan
        // 'username', // tambahkan kembali jika memang ada dan digunakan
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // Di Laravel 11, casts didefinisikan sebagai method
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the applications (pengajuan) submitted by the user.
     */
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}