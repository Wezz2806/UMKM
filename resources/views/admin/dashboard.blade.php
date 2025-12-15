@extends('layouts.admin')

@push('styles')
<style>
    body { background: #f7fafd; }
    .dashboard-main { padding: 2rem 0; }
    .dashboard-cards {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .dashboard-card {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 1.5rem 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        min-width: 200px;
    }
    .dashboard-card .card-title {
        color: #888;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    .dashboard-card .card-value {
        font-size: 2rem;
        font-weight: bold;
        color: #16a34a; /* hijau utama */
        margin-bottom: 0.5rem;
    }
    .dashboard-card .card-action {
        color: #16a34a;
        text-decoration: none;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.5rem 1.2rem;
        background: #e8f7ee;
        box-shadow: 0 2px 8px rgba(22,163,74,0.08);
        transition: background 0.25s, color 0.25s, transform 0.18s, box-shadow 0.18s;
        display: inline-block;
        margin-top: 0.5rem;
        letter-spacing: 0.01em;
    }
    .dashboard-card .card-action:hover {
        background: #16a34a;
        color: #fff;
        text-decoration: none;
        transform: translateY(-2px) scale(1.06);
        box-shadow: 0 6px 18px rgba(22,163,74,0.13);
    }
    .dashboard-section {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
    }
    .dashboard-section .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .dashboard-section .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #222;
    }
    .dashboard-section .section-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1a56db;
    }
    .dashboard-section .section-sort {
        font-size: 1rem;
        color: #888;
        background: #f3f4f6;
        border: none;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        margin-left: 1rem;
    }
    .dashboard-chart-row {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .dashboard-chart-container {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        flex: 2;
        padding: 2rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .dashboard-pie-container {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        flex: 1;
        padding: 2rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-width: 320px;
    }
    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .dashboard-table th, .dashboard-table td {
        padding: 1rem 1.25rem;
        text-align: left;
    }
    .dashboard-table th {
        background: #f7fafd;
        color: #888;
        font-size: 0.95rem;
        font-weight: 600;
    }
    .dashboard-table tr:not(:last-child) {
        border-bottom: 1px solid #f3f4f6;
    }
    .dashboard-table .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #fff;
        display: inline-block;
    }
    .dashboard-table .status-approved { background: #22c55e; }
    .dashboard-table .status-pending { background: #f59e0b; }
    .dashboard-table .status-rejected { background: #ef4444; }
    .dashboard-table .status-completed { background: #4f46e5; }
    .dashboard-table .status-pending_detail_usaha { background: #fbbf24; color: #222; }
    .dashboard-table .status-other { background: #888; }
    .dashboard-table .card-action {
        color: #16a34a;
        text-decoration: none;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.35rem 1.1rem;
        background: #e8f7ee;
        transition: background 0.2s, color 0.2s;
        display: inline-block;
    }
    .dashboard-table .card-action:hover {
        background: #16a34a;
        color: #fff;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="dashboard-main">
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-title">Total Applications</div>
            <div class="card-value">{{ $totalApplications ?? 0 }}</div>
            <a href="{{ route('admin.pengajuan.index') }}" class="card-action">Lihat semua pengajuan</a>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Pending Reviews</div>
            <div class="card-value">{{ $pendingReviews ?? 0 }}</div>
            <a href="{{ route('admin.pengajuan.index', ['status' => 'pending_review']) }}" class="card-action">Lihat pending review</a>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Approved</div>
            <div class="card-value">{{ $approvedApplicationsCount ?? 0 }}</div>
            <a href="{{ route('admin.pengajuan.index', ['status' => 'approved']) }}" class="card-action">Lihat sudah di approve</a>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Total Users</div>
            <div class="card-value">{{ $totalUsers ?? 0 }}</div>
            <a href="{{ route('admin.users.index') }}" class="card-action">Manage users</a>
        </div>
    </div>
    <div class="dashboard-chart-row">
        <div class="dashboard-chart-container">
            <div class="section-header" style="margin-bottom:1rem;">
                <div class="section-title">Application Statistics</div>
                <select class="section-sort" id="periodFilter" onchange="updatePeriod(this.value)">
                    <option value="daily" {{ $currentPeriod == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="monthly" {{ $currentPeriod == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ $currentPeriod == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
            <div style="width:100%;height:260px;">
                <canvas id="applicationsChart"></canvas>
            </div>
        </div>
        <div class="dashboard-pie-container">
            <div class="section-title" style="margin-bottom:1rem;">Status Distribution</div>
            <div style="width:100%;height:260px;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="dashboard-section">
        <div class="section-title mb-2">Recent Applications</div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Business Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentApplications ?? [] as $application)
                <tr>
                    <td>{{ $application->user_name ?? $application->nama }}</td>
                    <td>{{ $application->nama_usaha }}</td>
                    <td>{{ $application->jenis_usaha }}</td>
                    <td><span class="status-badge status-{{ str_replace(['_',' '],['-',''], strtolower($application->status)) }}">{{ ucfirst(str_replace(['_','-'],' ', $application->status)) }}</span></td>
                    <td>{{ $application->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('admin.pengajuan.edit', $application) }}" class="card-action">View</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">No recent applications found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
// Applications Chart
const applicationsElem = document.getElementById('applicationsChart');
if (applicationsElem) {
    const applicationsCtx = applicationsElem.getContext('2d');
    const applicationLabels = @json($monthlyStats->pluck('label')->toArray());
    const applicationCounts = @json($monthlyStats->pluck('count')->map(function($v){ return (int)$v; })->toArray());
    new Chart(applicationsCtx, {
        type: 'line',
        data: {
            labels: applicationLabels,
            datasets: [{
                label: 'Applications',
                data: applicationCounts,
                borderColor: 'rgb(26, 86, 219)',
                backgroundColor: 'rgba(26, 86, 219, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: 10
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        drawBorder: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
// Status Distribution Chart
const statusCtx = document.getElementById('statusChart')?.getContext('2d');
if (statusCtx) {
    const statusLabels = ['Pending Review', 'Pending Detail Usaha', 'Approved', 'Rejected', 'Completed'];
    const statusData = [
        {{ (int)($statusStats['pending_review'] ?? 0) }},
        {{ (int)($statusStats['pending_detail_usaha'] ?? 0) }},
        {{ (int)($statusStats['approved'] ?? 0) }},
        {{ (int)($statusStats['rejected'] ?? 0) }},
        {{ (int)($statusStats['completed'] ?? 0) }}
    ];
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: [
                    'rgb(245, 158, 11)',  // pending review
                    'rgb(251, 191, 36)',  // pending detail usaha
                    'rgb(34, 197, 94)',   // approved
                    'rgb(239, 68, 68)',   // rejected
                    'rgb(79, 70, 229)'    // completed
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: 20
            },
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });
}
function updatePeriod(period) {
    window.location.href = `{{ route('admin.dashboard') }}?period=${period}`;
}
</script>
@endsection
