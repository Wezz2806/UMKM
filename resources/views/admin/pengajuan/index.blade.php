@extends('layouts.admin')

<style>
    :root {
        --primary: #1a56db;
        --secondary: #4f46e5;
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #3b82f6;
        --background: #f3f4f6;
        --text: #1f2937;
        --text-light: #6b7280;
        --white: #ffffff;
    }

    .content-container {
        padding: 2rem;
        background-color: var(--background);
        min-height: 100vh;
    }

    .content-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text);
    }

    .filter-section {
        background: var(--white);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        font-size: 0.875rem;
        color: var(--text);
        font-weight: 500;
    }

    .filter-select {
        padding: 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        background-color: var(--white);
        color: var(--text);
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(26, 86, 219, 0.1);
    }

    .filter-button {
        padding: 0.5rem 1rem;
        background-color: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-button:hover {
        background-color: rgb(26, 86, 219, 0.9);
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background-color: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.2);
        color: var(--success);
    }

    .applications-table {
        background: var(--white);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .applications-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .applications-table th {
        background-color: #f8fafc;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--text);
        border-bottom: 1px solid #e5e7eb;
    }

    .applications-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        color: var(--text);
    }

    .applications-table tr:hover {
        background-color: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-pending_detail_usaha { background-color: var(--warning); color: white; }
    .status-pending_review { background-color: var(--info); color: white; }
    .status-approved { background-color: var(--success); color: white; }
    .status-rejected { background-color: var(--danger); color: white; }
    .status-completed { background-color: var(--secondary); color: white; }

    .action-button {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .action-button.view {
        background-color: var(--primary);
        color: var(--white);
    }

    .action-button.view:hover {
        background-color: rgb(26, 86, 219, 0.9);
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-link {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        background-color: var(--white);
        color: var(--text);
        text-decoration: none;
        transition: all 0.2s;
    }

    .pagination-link:hover,
    .pagination-link.active {
        background-color: var(--primary);
        color: var(--white);
    }
</style>

@section('content')
<div class="content-container">
    <div class="content-header">
        <h1 class="page-title">Manajemen Pengajuan Dana UMKM</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="filter-section">
        <form method="GET" action="{{ route('admin.pengajuan.index') }}" class="filter-grid">
            <div class="filter-group">
                <label for="status_filter" class="filter-label">Status Pengajuan:</label>
                <select name="status_filter" id="status_filter" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="pending_detail_usaha" {{ request('status_filter') == 'pending_detail_usaha' ? 'selected' : '' }}>Pending Detail Usaha</option>
                    <option value="pending_review" {{ request('status_filter') == 'pending_review' ? 'selected' : '' }}>Pending Review</option>
                    <option value="approved" {{ request('status_filter') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status_filter') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="date_filter" class="filter-label">Tanggal Pengajuan:</label>
                <select name="date_filter" id="date_filter" class="filter-select">
                    <option value="">Semua Waktu</option>
                    <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </div>

            <div class="filter-group">
                <button type="submit" class="filter-button">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="applications-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemohon</th>
                    <th>Nama Usaha</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuans as $pengajuan)
                <tr>
                    <td>{{ $pengajuan->id }}</td>
                    <td>{{ $pengajuan->nama }}</td>
                    <td>{{ $pengajuan->nama_usaha ?? '-' }}</td>
                    <td>Rp {{ number_format($pengajuan->nominal, 0, ',', '.') }}</td>
                    <td>
                        <span class="status-badge status-{{ $pengajuan->status }}">
                            {{ str_replace('_', ' ', $pengajuan->status) }}
                        </span>
                    </td>
                    <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.pengajuan.edit', $pengajuan) }}" class="action-button view">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengajuans->hasPages())
    <div class="pagination">
        {{ $pengajuans->links() }}
    </div>
    @endif
</div>
@endsection