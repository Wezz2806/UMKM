<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    /**
     * Menampilkan halaman status pengajuan untuk pengguna atau semua pengajuan untuk admin.
     */
    public function showStatus(): View
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $pengajuanItems = Pengajuan::orderBy('tgl_pengajuan', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $pengajuanItems = Pengajuan::where('user_id', $user->id)
                ->orderBy('tgl_pengajuan', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        return view('pinjaman.status', compact('pengajuanItems'));
    }

    /**
     * Menampilkan daftar semua pengajuan untuk Admin dengan paginasi dan filter.
     */
    public function indexAdmin(Request $request): View
    {
        $query = Pengajuan::with('user');

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'pending') {
                $query->whereIn('status', ['pending_review', 'pending_detail_usaha']);
            } else {
                $query->where('status', $status);
            }
        }

        if ($request->filled('date_filter')) {
            $dateFilter = $request->date_filter;
            switch ($dateFilter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        $query->orderBy('created_at', 'desc');
        $pengajuans = $query->paginate(10)->withQueryString();

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Menampilkan formulir data diri (tahap 1).
     */
    public function create(): View
    {
        return view('pinjaman.create');
    }

    /**
     * Menyimpan data diri (tahap 1) dan mengarahkan ke tahap 2.
     */
    public function storeDiri(Request $request)
    {
        $validatedData = $request->validate([
            'nid' => ['required', 'string', 'max:255', Rule::unique('pengajuan', 'nid')],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'dusun' => 'required|string|in:BEJEN,BAREPAN,NGENTAK,BROJONALAN,GEDONGAN,SOROPADAN,TINGAL,JOWAHAN',
            'ktp' => 'required|file|mimes:pdf|max:2048',
            'kk' => 'required|file|mimes:pdf|max:2048',
        ]);

        $dataToSave = [
            'nid' => $validatedData['nid'],
            'nama' => $validatedData['nama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'telepon' => $validatedData['telepon'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'dusun' => $validatedData['dusun'],            
            'tgl_pengajuan' => now(),
            'status' => 'pending_detail_usaha',
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('ktp')) {
            $dataToSave['ktp_path'] = $request->file('ktp')->store('dokumen_pengajuan/ktp', 'public');
        }
        if ($request->hasFile('kk')) {
            $dataToSave['kk_path'] = $request->file('kk')->store('dokumen_pengajuan/kk', 'public');
        }

        $pengajuan = Pengajuan::create($dataToSave);

        return redirect()->route('pinjaman.createDetails', ['pengajuan_nid' => $pengajuan->nid])
                         ->with('success', 'Data diri berhasil disimpan. Silakan lengkapi detail usaha Anda.');
    }

    /**
     * Menampilkan formulir detail usaha dan pinjaman (tahap 2).
     */
    public function createDetails($pengajuan_nid): View
    {
        $pengajuan = Pengajuan::where('nid', $pengajuan_nid)->firstOrFail();
        return view('pinjaman.create_details', compact('pengajuan'));
    }

    /**
     * Menyimpan/Update detail usaha dan pinjaman (tahap 2).
     */
    public function storeDetails(Request $request, $pengajuan_nid)
    {
        $pengajuan = Pengajuan::where('nid', $pengajuan_nid)->firstOrFail();
        
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tujuan_pendanaan' => 'required|string|max:255',
            'norek' => 'required|string|max:50',
            'bank' => 'required|string|max:100',
            'pemilik_rekening' => 'required|string|max:255',
            'tenor' => 'required|integer|min:1',
            'proposal' => 'sometimes|file|mimes:pdf|max:5120',
            'setuju' => 'required|accepted',
        ]);
        
        $dataToUpdate = [
            'nama_usaha' => $validatedData['nama_usaha'],
            'jenis_usaha' => $validatedData['jenis_usaha'],
            'nominal' => $validatedData['nominal'],
            'tujuan_pendanaan' => $validatedData['tujuan_pendanaan'],
            'norek' => $validatedData['norek'],
            'bank' => $validatedData['bank'],
            'pemilik_rekening' => $validatedData['pemilik_rekening'],
            'tenor' => $validatedData['tenor'],
            'status' => 'pending_review',
            'setuju' => true,
        ];

        if ($request->hasFile('proposal')) {
            if ($pengajuan->proposal_path && Storage::disk('public')->exists($pengajuan->proposal_path)) {
                Storage::disk('public')->delete($pengajuan->proposal_path);
            }
            $dataToUpdate['proposal_path'] = $request->file('proposal')->store('dokumen_pengajuan/proposal', 'public');
        }
        
        $pengajuan->update($dataToUpdate);

        return redirect()->route('pinjaman.status')->with('success', 'Pengajuan pinjaman Anda telah lengkap dan berhasil dikirim untuk direview!');
    }

    /**
     * Menampilkan form edit pengajuan untuk Admin.
     */
    public function editPengajuan(Pengajuan $pengajuan): View
    {
        return view('admin.pengajuan.edit', compact('pengajuan'));
    }

    /**
     * Memproses update pengajuan dari Admin.
     */
    public function updatePengajuan(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nid' => ['required','string','max:255', Rule::unique('pengajuan', 'nid')->ignore($pengajuan->id)],
            'email' => 'required|email|max:255',
            'dusun' => 'required|string|in:BEJEN,BAREPAN,NGENTAK,BROJONALAN,GEDONGAN,SOROPADAN,TINGAL,JOWAHAN',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending_detail_usaha,pending_review,approved,rejected,completed',
        ]);

        $pengajuan->update($validatedData);
        return redirect()->route('admin.pengajuan.index')->with('success', 'Data pengajuan berhasil diupdate.');
    }
    
    /**
     * Mengubah status pengajuan oleh Admin.
     */
    public function updateStatusPengajuan(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending_detail_usaha,pending_review,approved,rejected,completed',
        ]);
        $pengajuan->update(['status' => $validatedData['status']]);
        return redirect()->route('admin.pengajuan.index')->with('success', 'Status pengajuan berhasil diubah.');
    }

    /**
     * Menghapus pengajuan oleh Admin.
     */
    public function destroyPengajuan(Pengajuan $pengajuan)
    {
        if ($pengajuan->ktp_path) Storage::disk('public')->delete($pengajuan->ktp_path);
        if ($pengajuan->kk_path) Storage::disk('public')->delete($pengajuan->kk_path);
        if ($pengajuan->proposal_path) Storage::disk('public')->delete($pengajuan->proposal_path);
        
        $pengajuan->delete();
        return redirect()->route('admin.pengajuan.index')->with('success', 'Data pengajuan berhasil dihapus.');
    }

    // ===================================================================================
    // [PERBAIKAN] MENAMBAHKAN KEMBALI METODE-METODE STATISTIK YANG HILANG
    // ===================================================================================

    /**
     * Menyediakan data untuk chart berdasarkan dusun.
     */
    public function getApprovedByDusunData(): JsonResponse
    {
        $data = Pengajuan::whereIn('status', ['approved', 'completed'])
            ->select('dusun', DB::raw('count(*) as total'))
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->get();

        $labels = $data->pluck('dusun');
        $data = $data->pluck('total');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    /**
     * Mengambil statistik pengajuan yang disetujui per dusun.
     */
    public function getStatistikPerDusun(): JsonResponse
    {
        $data = Pengajuan::select('dusun', DB::raw('count(*) as total'))
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->get();

        return response()->json([
            'labels' => $data->pluck('dusun')->map(fn($dusun) => 'Dusun ' . $dusun),
            'data' => $data->pluck('total'),
        ]);
    }

    /**
     * Get public statistics for the welcome page.
     * INI ADALAH METODE YANG MENYEBABKAN ERROR KARENA TIDAK DITEMUKAN.
     */
    public function getPublicStatistics(): array
    {
        $totalPengajuan = Pengajuan::count();
        $approvedPengajuan = Pengajuan::where('status', 'approved')->count();
        
        $dusunList = ['BEJEN', 'BAREPAN', 'NGENTAK', 'BROJONALAN', 'GEDONGAN', 'SOROPADAN', 'TINGAL', 'JOWAHAN'];
        
        $approvedByDusun = Pengajuan::select('dusun', DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->groupBy('dusun')
            ->pluck('total', 'dusun')
            ->toArray();

        $pengajuanByDusun = collect($dusunList)->map(function ($dusun) use ($approvedByDusun) {
            return [
                'dusun' => $dusun,
                'total' => $approvedByDusun[$dusun] ?? 0
            ];
        });

        $recentPengajuan = Pengajuan::select('nama', 'dusun', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $monthlyLabels = [];
        $monthlyData = [];
        $now = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $label = $date->format('M Y');
            $monthlyLabels[] = $label;
            $monthlyData[] = Pengajuan::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        $statusCounts = [
            'approved' => $approvedPengajuan,
            'pending' => Pengajuan::whereIn('status', ['pending_review', 'pending_detail_usaha'])->count(),
            'rejected' => Pengajuan::where('status', 'rejected')->count(),
        ];

        return [
            'totalPengajuan' => $totalPengajuan,
            'approvedPengajuan' => $approvedPengajuan,
            'pengajuanByDusun' => $pengajuanByDusun,
            'recentPengajuan' => $recentPengajuan,
            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,
            'statusCounts' => $statusCounts,
            'pendingPengajuan' => $statusCounts['pending'],
            'rejectedPengajuan' => $statusCounts['rejected'],
        ];
    }
}