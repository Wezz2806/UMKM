<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $chartData = $this->getChartData($period);

        // Get recent applications with complete user data
        $recentApplications = Pengajuan::select(
            'pengajuan.id',
            'pengajuan.nama',
            'pengajuan.nama_usaha',
            'pengajuan.jenis_usaha',
            'pengajuan.status',
            'pengajuan.created_at',
            'users.name as user_name'
        )
        ->leftJoin('users', 'pengajuan.user_id', '=', 'users.id')
        ->latest('pengajuan.created_at')
        ->take(5)
        ->get();        // Status normalization agar chart selalu muncul dan urut
        $allStatuses = ['pending_review', 'pending_detail_usaha', 'approved', 'rejected', 'completed'];
        $statusCounts = Pengajuan::selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->whereIn(DB::raw('LOWER(status)'), $allStatuses)
            ->groupBy(DB::raw('LOWER(status)'))
            ->get()
            ->pluck('count', 'status')
            ->toArray();
        $statusStats = collect($allStatuses)->mapWithKeys(function ($status) use ($statusCounts) {
            return [$status => $statusCounts[$status] ?? 0];
        });
        $approvedApplicationsCount = $statusStats['approved'] ?? 0;
        $data = [
            'totalApplications' => Pengajuan::count(),            
            'pendingReviews' => Pengajuan::where('status', 'Pending_review')->count(),
            'approvedToday' => Pengajuan::where('status', 'approved')
                ->whereDate('updated_at', Carbon::today())
                ->count(),
            'approvedApplicationsCount' => $approvedApplicationsCount,
            'totalUsers' => User::where('role', '!=', 'admin')->count(),
            'recentApplications' => $recentApplications,
            'currentPeriod' => $period,
            'monthlyStats' => $chartData,
            'statusStats' => $statusStats
        ];

        return view('admin.dashboard', $data);
    }

    private function getChartData($period)
    {
        $today = Carbon::today();
        
        switch ($period) {
            case 'daily':
                $startDate = $today->copy()->subDays(7);
                $groupFormat = '%Y-%m-%d';
                break;
            case 'monthly':
                $startDate = $today->copy()->startOfMonth()->subMonths(11);
                $groupFormat = '%Y-%m';
                break;
            case 'yearly':
                $startDate = $today->copy()->startOfYear()->subYears(4);
                $groupFormat = '%Y';
                break;
            default:
                $startDate = $today->copy()->startOfMonth()->subMonths(11);
                $groupFormat = '%Y-%m';
        }

        $stats = Pengajuan::select(
            DB::raw("DATE_FORMAT(created_at, '$groupFormat') as label"),
            DB::raw('count(*) as count')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('label')
        ->orderBy('label')
        ->get();

        // Ensure we have data for all periods
        $allPeriods = [];
        $current = $startDate->copy();
        $end = $today;

        while ($current <= $end) {
            $allPeriods[$current->format('Y-m')] = 0;
            $current->addMonth();
        }

        // Fill in actual values
        foreach ($stats as $stat) {
            $allPeriods[$stat->label] = $stat->count;
        }

        // Convert to array format
        $result = collect($allPeriods)->map(function ($count, $label) {
            return [
                'label' => $label,
                'count' => $count
            ];
        })->values();

        return $result;
    }
}
