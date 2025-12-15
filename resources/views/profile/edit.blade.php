@extends('layouts.app')

@section('content')
{{-- Latar belakang halaman disamakan dengan welcome.blade.php --}}
<div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    {{-- Container utama dengan padding yang konsisten --}}
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Header halaman yang besar dan deskriptif, meniru gaya welcome.blade.php --}}
        <header class="mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white">
                Pengaturan Profil
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">
                Kelola informasi akun Anda untuk menjaga keamanan dan memastikan data tetap terbaru.
            </p>
        </header>

        {{-- Wrapper untuk kartu-kartu konten dengan spasi vertikal --}}
        <div class="space-y-8">

            {{-- KARTU 1: Update Informasi Profil --}}
            {{-- Desain kartu ini (rounded-2xl, shadow-lg) diambil langsung dari welcome.blade.php --}}
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8">
                {{-- max-w-2xl membatasi lebar form agar mudah dibaca --}}
                <div class="max-w-2xl">
                    {{-- Kita tetap menggunakan partial dari Breeze karena fungsionalitasnya sudah ada di sana --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            {{-- KARTU 2: Update Password --}}
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            {{-- KARTU 3: Hapus Akun --}}
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </main>
</div>
@endsection