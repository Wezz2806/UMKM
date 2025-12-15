@extends('layouts.app')

@push('styles')
<style>
    :    <div class="relative pt-24 pb-6 px-4 sm:px-6 lg:px-8">
        <!-- Back to Home Button - Fixed Position -->
        <div class="fixed top-24 left-4 z-10">
            <a href="{{ url('dashboard') }}" 
                class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-sm{
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

    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        z-index: 0;
        opacity: 0.4;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>
@endpush

@section('content')
<div class="relative min-h-screen">    <!-- Main Content -->
    <div class="relative pt-24 pb-6 px-4 sm:px-6 lg:px-8">
        <!-- Back to Home Button - Fixed Position -->
        <div class="fixed top-24 left-4 z-10">
            <a href="{{ url('dashboard') }}" 
                class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-sm
                hover:bg-white transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 text-green-600 group-hover:-translate-x-1 transition-transform" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="text-gray-700">Kembali ke Beranda</span>
            </a>
        </div>
        
        <div class="max-w-4xl mx-auto">
            
            <!-- Form Card -->
            <div class="glass-effect rounded-3xl shadow-xl overflow-hidden">
                <div class="p-6 sm:p-10">                <div class="text-center mb-12">
                    <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                        Formulir <span class="gradient-text">Pengajuan</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Lengkapi data diri Anda dengan teliti. Pastikan semua informasi yang dimasukkan sesuai dengan dokumen resmi.
                    </p>
                </div>
                  {{-- Tampilkan error validasi jika ada --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl" role="alert">
                        <p class="font-semibold text-base">Oops! Terjadi Kesalahan</p>
                        <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="PengajuanForm" action="{{ route('pinjaman.storeDiri') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                    @csrf {{-- CSRF Token Laravel --}}                    {{-- NID --}}
                    <div>
                        <label for="nid" class="block text-sm font-medium text-gray-700">Nomor Identitas (NID/NIK)</label>
                        <input type="text" id="nid" name="nid" value="{{ old('nid') }}" required 
                            class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                            focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                            placeholder:text-gray-400">
                    </div>                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required 
                            class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                            focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                            placeholder:text-gray-400">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }} required 
                                    class="w-4 h-4 border border-gray-200 text-green-600 focus:ring-2 focus:ring-green-200 transition-all">
                                <span class="ms-2 text-sm text-gray-600">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }} required 
                                    class="w-4 h-4 border border-gray-200 text-green-600 focus:ring-2 focus:ring-green-200 transition-all">
                                <span class="ms-2 text-sm text-gray-600">Perempuan</span>
                            </label>
                        </div>
                    </div>
                      {{-- Tempat & Tanggal Lahir (digabung dalam satu baris) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                        </div>
                    </div>                    {{-- Alamat & Dusun --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
                            <textarea id="alamat" name="alamat" rows="3" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400">{{ old('alamat') }}</textarea>
                        </div>
                        <div>
                            <label for="dusun" class="block text-sm font-medium text-gray-700">Dusun</label>
                            <select id="dusun" name="dusun" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                                <option value="">- Pilih Dusun -</option>
                                <option value="BEJEN" {{ old('dusun') == 'BEJEN' ? 'selected' : '' }}>BEJEN</option>
                                <option value="BAREPAN" {{ old('dusun') == 'BAREPAN' ? 'selected' : '' }}>BAREPAN</option>
                                <option value="NGENTAK" @if(old('dusun') == 'NGENTAK') selected @endif>NGENTAK</option>
                                <option value="BROJONALAN" @if(old('dusun') == 'BROJONALAN') selected @endif>BROJONALAN</option>
                                <option value="GEDONGAN" @if(old('dusun') == 'GEDONGAN') selected @endif>GEDONGAN</option>
                                <option value="SOROPADAN" @if(old('dusun') == 'SOROPADAN') selected @endif>SOROPADAN</option>
                                <option value="TINGAL" @if(old('dusun') == 'TINGAL') selected @endif>TINGAL</option>
                                <option value="JOWAHAN" @if(old('dusun') == 'JOWAHAN') selected @endif>JOWAHAN</option>
                                {{-- ... opsi dusun lainnya ... --}}
                            </select>
                        </div>
                    </div>                    {{-- Email & Telepon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Pemohon</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400">
                        </div>
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon/WA Aktif</label>
                            <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                placeholder:text-gray-400" placeholder="Contoh: 08123456789">
                        </div>
                    </div>

                    {{-- Upload Dokumen --}}
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-2">Upload <span class="gradient-text">Dokumen</span></h2>
                        <p class="text-gray-600">Lampirkan dokumen pendukung dalam format PDFG</p>
                    </div><div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="ktp" class="block text-sm font-medium text-gray-700">Scan KTP Pemohon (PDF)</label>
                            <input type="file" id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                                file:text-sm file:font-medium file:bg-green-50 file:text-green-700 
                                hover:file:bg-green-100 cursor-pointer">
                        </div>
                        <div>
                            <label for="kk" class="block text-sm font-medium text-gray-700">Scan Kartu Keluarga (PDF)</label>
                            <input type="file" id="kk" name="kk" accept=".pdf" required 
                                class="mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm
                                focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all
                                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                                file:text-sm file:font-medium file:bg-green-50 file:text-green-700 
                                hover:file:bg-green-100 cursor-pointer">
                        </div>
                    </div>
                      {{-- Tombol Submit --}}
                    <div class="flex items-center justify-center mt-12">
                        <button type="submit" 
                            class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-white 
                            bg-gradient-to-r from-green-600 to-green-500 
                            hover:from-green-700 hover:to-green-600
                            rounded-xl shadow-lg shadow-green-500/30
                            transform transition-all duration-300
                            hover:shadow-xl hover:shadow-green-500/40 hover:scale-[1.02]
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Jika ada JS kustom untuk halaman ini --}}
@endpush