@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Status <span class="gradient-text">Pengajuan</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Pantau status pengajuan pinjaman UMKM Anda secara real-time
            </p>
        </div>

        <!-- Action Button -->
        <div class="text-center mb-8">
            <a href="{{ route('pinjaman.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-accent hover:from-secondary hover:to-primary text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-2xl hover:scale-105 transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Ajukan Pinjaman Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-lg animate-fade-in-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($pengajuanItems->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-100 animate-fade-in-up">
                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    📝
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-gray-600 mb-8">
                    Anda belum memiliki riwayat pengajuan dana. <br>
                    Mulai ajukan pinjaman untuk UMKM Anda sekarang.
                </p>
                <a href="{{ route('pinjaman.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-accent hover:from-secondary hover:to-primary text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-2xl hover:scale-105 transform">
                    Ajukan Pinjaman
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($pengajuanItems as $item)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 animate-fade-in-up">
                    <div class="sm:flex sm:items-start sm:justify-between">
                        <div>
                            <div class="flex items-center flex-wrap gap-3">
                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold
                                    @if($item->status == 'approved' || $item->status == 'completed') 
                                        bg-gradient-to-r from-green-500 to-green-600 text-white
                                    @elseif($item->status == 'rejected') 
                                        bg-gradient-to-r from-red-500 to-red-600 text-white
                                    @elseif($item->status == 'pending_detail_usaha') 
                                        bg-gradient-to-r from-blue-500 to-blue-600 text-white
                                    @else 
                                        bg-gradient-to-r from-yellow-500 to-yellow-600 text-white
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </span>

                                @if($item->status == 'pending_detail_usaha')
                                    <a href="{{ route('pinjaman.createDetails', ['pengajuan_nid' => $item->nid]) }}" 
                                       class="inline-flex items-center text-primary hover:text-secondary font-semibold transition-colors duration-300">
                                        Lanjutkan Pengisian
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                            </div>

                            <h4 class="mt-4 text-xl font-bold text-gray-900">{{ $item->nama_usaha ?? 'Pengajuan Dana' }}</h4>
                            <p class="text-gray-500">NID: {{ $item->nid }}</p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-6 text-right">
                            <p class="text-2xl font-bold gradient-text">Rp {{ number_format($item->nominal, 0, ',', '.') }}</p>
                            <p class="text-gray-500">Tenor: {{ $item->tenor ?? '-' }} bulan</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->isoFormat('dddd, D MMMM YYYY') }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pemohon</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $item->nama }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $item->email }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Usaha</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $item->jenis_usaha ?? '-' }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dokumen Terlampir</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 space-x-3">
                                    @if($item->ktp_path)<a href="{{ Storage::url($item->ktp_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>KTP</a>@endif
                                    @if($item->kk_path)<a href="{{ Storage::url($item->kk_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>KK</a>@endif
                                    @if($item->proposal_path)<a href="{{ Storage::url($item->proposal_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>Proposal</a>@endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                @endforeach
            </div>

            @if($pengajuanItems->hasPages())
                <div class="mt-8">
                    {{ $pengajuanItems->links() }}
                </div>
            @endif
        @endif

        <!-- Back to Dashboard Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary hover:text-secondary border-2 border-primary hover:border-secondary font-semibold rounded-xl transition-all duration-300 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
