<section>
    <header>
        <h2 class="text-2xl font-bold text-white">
            Perbarui Kata Sandi
        </h2>
        <p class="mt-2 text-base text-gray-400">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-400">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-400">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password"
                   class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-400">Konfirmasi Kata Sandi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-green-600 text-white font-bold text-xs uppercase rounded-lg hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                Simpan
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-400">
                   Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>