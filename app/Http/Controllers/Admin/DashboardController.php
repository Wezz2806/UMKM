<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan; // Import model Pengajuan
use App\Models\User;      // Import model User
use Illuminate\Http\Request; // Meskipun tidak digunakan di method index, tidak masalah untuk tetap ada
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Ambil data statistik
        // Menggabungkan kondisi 'pending_review' dan 'pending_detail_usaha' untuk $pendingApplicationsCount
        $pendingApplicationsCount = Pengajuan::whereIn('status', ['pending_review', 'pending_detail_usaha'])
                                        ->count(); // ->count() dipanggil setelah whereIn selesai

        dd(Pengajuan::where('status', 'approved')->count());
        
        $totalUsersCount = User::where('role', 'user')->count(); // Hanya hitung user biasa
        return view('admin.dashboard', compact(
            'pendingApplicationsCount',
            'approvedApplicationsCount',
            'totalUsersCount' // Pastikan tidak ada koma setelah variabel terakhir di sini
        ));
    }
}
