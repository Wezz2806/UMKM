<section>
    <header>
        <h2 class="text-2xl font-bold text-white">
            Informasi Profil
        </h2>
        <p class="mt-2 text-base text-gray-400">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-400">Nama</label>
            <input id="name" name="name" type="text"
                   class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-400">Email</label>
            <input id="email" name="email" type="email"
                   class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-400">
                        Alamat email Anda belum terverifikasi.
                        <button form="send-verification" class="underline text-sm text-green-400 hover:text-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-green-500">
                            Kirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-green-600 text-white font-bold text-xs uppercase rounded-lg hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                Simpan
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-400">
                   Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>