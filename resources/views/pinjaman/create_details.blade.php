@extends('layouts.app') {{-- Atau layout yang sesuai, misal layouts.admin --}}

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Detail Usaha dan Pinjaman') }}
    </h2>
@endsection

@push('styles')
<style>
    :root {
        --tw-primary: #16a34a;
        --tw-accent: #22c55e;
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, var(--tw-primary), var(--tw-accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        border-color: var(--tw-primary);
        box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.2);
    }
    
    .form-radio:checked {
        background-color: var(--tw-primary);
        border-color: var(--tw-primary);
    }
    
    .form-radio:focus {
        --tw-ring-color: rgba(22, 163, 74, 0.2);
    }
</style>
@endpush

@section('content')
<div class="relative min-h-screen">
    <div class="relative pt-24 pb-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="glass-effect rounded-3xl shadow-xl overflow-hidden">
                <div class="p-6 sm:p-10">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                            Detail <span class="gradient-text">Usaha & Pinjaman</span>
                        </h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            NID Pengajuan: {{ $pengajuan->nid }} - Pemohon: {{ $pengajuan->nama }}
                        </p>
                    </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('success') }}
                    </div>
                @endif                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl" role="alert">
                        <p class="font-semibold text-base">Oops! Terjadi Kesalahan</p>
                        <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="PengajuanDetailForm" action="{{ route('pinjaman.storeDetails', ['pengajuan_nid' => $pengajuan->nid]) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                    @csrf                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_usaha" class="block text-sm font-medium text-gray-700">Nama Usaha Yang Diajukan</label>
                            <input type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha', $pengajuan->nama_usaha) }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400" placeholder="Contoh: Warung Sembako Berkah">
                        </div>
                        <div>
                            <label for="jenis_usaha" class="block text-sm font-medium text-gray-700">Jenis Usaha</label>
                            <select id="jenis_usaha" name="jenis_usaha" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                                <option value="">- Pilih Jenis Usaha -</option>
                                <option value="kuliner" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'kuliner' ? 'selected' : '' }}>Usaha Kuliner</option>
                                <option value="furnitur" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'furnitur' ? 'selected' : '' }}>Furnitur dan Peralatan Rumah Tangga</option>                                                          
                                <option value="pertanian" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="peternakan" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'peternakan' ? 'selected' : '' }}>Peternakan</option>
                                <option value="jasa" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="perdagangan" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                <option value="manufaktur" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                                <option value="kerajinan" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                <option value="lainnya" {{ old('jenis_usaha', $pengajuan->jenis_usaha) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tujuan_pendanaan" class="block text-sm font-medium text-gray-700">Tujuan Pendanaan</label>
                            <select id="tujuan_pendanaan" name="tujuan_pendanaan" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                                <option value="">- Pilih Tujuan -</option>
                                <option value="modal" {{ old('tujuan_pendanaan', $pengajuan->tujuan_pendanaan) == 'modal' ? 'selected' : '' }}>Modal Usaha</option>
                                <option value="pengembangan" {{ old('tujuan_pendanaan', $pengajuan->tujuan_pendanaan) == 'pengembangan' ? 'selected' : '' }}>Mengembangkan Usaha</option>
                                <option value="investasi" {{ old('tujuan_pendanaan', $pengajuan->tujuan_pendanaan) == 'investasi' ? 'selected' : '' }}>Investasi</option>
                            </select>
                        </div>
                        <div>
                            <label for="nominal" class="block text-sm font-medium text-gray-700">Ekspektasi Nominal Pendanaan (Rp)</label>
                            <input type="number" id="nominal" name="nominal" value="{{ old('nominal', $pengajuan->nominal) }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400" placeholder="Contoh: 5000000">
                            <p class="mt-1 text-sm text-gray-500">Maksimal pinjaman Rp. 10.000.000</p>
                        </div>
                    </div>                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="norek" class="block text-sm font-medium text-gray-700">Nomor Rekening Tujuan</label>
                            <input type="text" id="norek" name="norek" value="{{ old('norek', $pengajuan->norek) }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400" placeholder="Contoh: 1234567890">
                        </div>
                        <div>
                            <label for="bank" class="block text-sm font-medium text-gray-700">Nama Bank</label>
                            <select id="bank" name="bank" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                                <option value="">- Pilih Bank -</option>
                                <option value="BCA" {{ old('bank', $pengajuan->bank) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="BNI" {{ old('bank', $pengajuan->bank) == 'BNI' ? 'selected' : '' }}>BNI</option>
                                <option value="Mandiri" {{ old('bank', $pengajuan->bank) == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="BRI" {{ old('bank', $pengajuan->bank) == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="BSI" {{ old('bank', $pengajuan->bank) == 'BSI' ? 'selected' : '' }}>BSI</option>
                                <option value="BTN" {{ old('bank', $pengajuan->bank) == 'BTN' ? 'selected' : '' }}>BTN</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pemilik_rekening" class="block text-sm font-medium text-gray-700">Nama Pemilik Rekening</label>
                            <input type="text" id="pemilik_rekening" name="pemilik_rekening" value="{{ old('pemilik_rekening', $pengajuan->pemilik_rekening) }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400" placeholder="Nama sesuai buku tabungan">
                        </div>
                        <div>
                            <label for="tenor" class="block text-sm font-medium text-gray-700">Durasi Tenor</label>
                            <select id="tenor" name="tenor" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                                <option value="">- Pilih Tenor -</option>
                                <option value="3" {{ old('tenor', $pengajuan->tenor) == '3' ? 'selected' : '' }}>3 bulan</option>
                                <option value="6" {{ old('tenor', $pengajuan->tenor) == '6' ? 'selected' : '' }}>6 bulan</option>
                                <option value="12" {{ old('tenor', $pengajuan->tenor) == '12' ? 'selected' : '' }}>1 tahun (12 bulan)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="proposal" class="block text-sm font-medium text-gray-700">Proposal Bisnis UMKM (PDF)</label>
                        <input type="file" id="proposal" name="proposal" accept=".pdf" {{ $pengajuan->proposal_path ? '' : 'required' }} 
                            class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                            focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                            file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                            file:text-sm file:font-medium file:bg-green-50 file:text-green-700 
                            hover:file:bg-green-100 cursor-pointer">
                        @if($pengajuan->proposal_path)
                        <p class="text-xs text-gray-500 mt-1">Proposal sudah diunggah: <a href="{{ Storage::url($pengajuan->proposal_path) }}" target="_blank" class="text-indigo-500 hover:underline">Lihat Proposal</a>. Unggah file baru untuk mengganti.</p>
                        @endif
                    </div>                    <div class="mt-8">
                        <label for="setuju" class="inline-flex items-center">
                            <input type="checkbox" id="setuju" name="setuju" required 
                                class="w-4 h-4 border border-gray-200 text-green-600 rounded
                                focus:ring-2 focus:ring-green-200 focus:ring-offset-0 transition-all">
                            <span class="ms-2 text-sm text-gray-600">Dengan ini, saya menyatakan bahwa data yang saya isi dalam formulir ini adalah benar dan dapat dipertanggungjawabkan</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-center mt-12">
                        <button type="submit" 
                            class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-white 
                            bg-gradient-to-r from-green-600 to-green-500 
                            hover:from-green-700 hover:to-green-600
                            rounded-xl shadow-lg shadow-green-500/30
                            transform transition-all duration-300
                            hover:shadow-xl hover:shadow-green-500/40 hover:scale-[1.02]
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Kirim Pengajuan Lengkap
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection