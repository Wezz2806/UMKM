@extends('layouts.admin') {{-- Pastikan menggunakan layout admin Anda --}}

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Pengajuan Dana - ') }} {{ $pengajuan->nama }} (NID: {{ $pengajuan->nid }})
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-semibold mb-6">Edit Data Pengajuan</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops! Ada kesalahan:</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form untuk mengedit pengajuan --}}
                <form action="{{ route('admin.pengajuan.update', $pengajuan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- NID (Nomor Identitas) - Biasanya tidak diubah, atau perlu validasi unik dengan ignore --}}
                    <div>
                        <label for="nid" class="block font-medium text-sm text-gray-700 dark:text-gray-300">NID</label>
                        <input type="text" id="nid" name="nid" value="{{ old('nid', $pengajuan->nid) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>

                    {{-- Nama Pemohon --}}
                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Pemohon</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pengajuan->nama) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>

                    {{-- Email Pemohon --}}
                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $pengajuan->email) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>
                    
                     {{-- Dusun --}}
                     <div>
                        <label for="dusun" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Dusun</label>
                        <select id="dusun" name="dusun" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">- Pilih Dusun -</option>
                            <option value="BEJEN" {{ old('dusun', $pengajuan->dusun) == 'BEJEN' ? 'selected' : '' }}>BEJEN</option>
                            <option value="BAREPAN" {{ old('dusun', $pengajuan->dusun) == 'BAREPAN' ? 'selected' : '' }}>BAREPAN</option>
                            <option value="NGENTAK" {{ old('dusun', $pengajuan->dusun) == 'NGENTAK' ? 'selected' : '' }}>NGENTAK</option>
                            <option value="BROJONALAN" {{ old('dusun', $pengajuan->dusun) == 'BROJONALAN' ? 'selected' : '' }}>BROJONALAN</option>
                            <option value="GEDONGAN" {{ old('dusun', $pengajuan->dusun) == 'GEDONGAN' ? 'selected' : '' }}>GEDONGAN</option>
                            <option value="SOROPADAN" {{ old('dusun', $pengajuan->dusun) == 'SOROPADAN' ? 'selected' : '' }}>SOROPADAN</option>
                            <option value="TINGAL" {{ old('dusun', $pengajuan->dusun) == 'TINGAL' ? 'selected' : '' }}>TINGAL</option>
                            <option value="JOWAHAN" {{ old('dusun', $pengajuan->dusun) == 'JOWAHAN' ? 'selected' : '' }}>JOWAHAN</option>
                        </select>
                    </div>

                    {{-- Nominal Pengajuan --}}
                    <div>
                        <label for="nominal" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nominal (Rp)</label>
                        <input type="number" step="any" id="nominal" name="nominal" value="{{ old('nominal', $pengajuan->nominal) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>

                    {{-- Nama Usaha --}}
                    <div>
                        <label for="nama_usaha" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Usaha</label>
                        <input type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha', $pengajuan->nama_usaha) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>
                    
                    {{-- Status Pengajuan --}}
                    <div>
                        <label for="status" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Status Pengajuan</label>
                        <select name="status" id="status" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="pending_detail_usaha" {{ old('status', $pengajuan->status) == 'pending_detail_usaha' ? 'selected' : '' }}>Pending Detail Usaha</option>
                            <option value="pending_review" {{ old('status', $pengajuan->status) == 'pending_review' ? 'selected' : '' }}>Pending Review</option>
                            <option value="approved" {{ old('status', $pengajuan->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $pengajuan->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="completed" {{ old('status', $pengajuan->status) == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                        </select>
                    </div>

                    {{-- Tambahkan field lain yang relevan untuk diedit admin --}}
                    {{-- Contoh: Tanggal Pencairan, Tanggal Pengembalian, Catatan Admin, dll. --}}

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.pengajuan.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Update Pengajuan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection