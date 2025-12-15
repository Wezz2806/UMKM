<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a',
                        accent: '#22c55e',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="py-6 bg-white/90 border-b border-gray-200/50 glass-effect">
        <div class="container mx-auto flex items-center justify-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center text-white text-xl group-hover:scale-110 transition-transform duration-300">
                    🌾
                </div>
                <h1 class="text-xl font-bold gradient-text">DANA UMKM DESA</h1>
            </a>
        </div>
    </header>
    <main class="flex flex-col items-center justify-center min-h-[80vh] px-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 md:p-10 mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Reset Password</h2>
            <p class="text-gray-500 mb-6 text-center">Masukkan email dan password baru Anda.</p>
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                        class="block w-full bg-gray-50 border border-gray-200 text-gray-700 focus:border-primary focus:ring-primary rounded-lg shadow-sm px-4 py-3">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1">Password Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full bg-gray-50 border border-gray-200 text-gray-700 focus:border-primary focus:ring-primary rounded-lg shadow-sm px-4 py-3">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="block w-full bg-gray-50 border border-gray-200 text-gray-700 focus:border-primary focus:ring-primary rounded-lg shadow-sm px-4 py-3">
                    @error('password_confirmation')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-accent text-white font-bold rounded-xl py-3 transition-all duration-300 shadow">
                    Reset Password
                </button>
            </form>
            <div class="mt-6 text-center text-gray-600">
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Kembali ke Login</a>
            </div>
        </div>
    </main>
</body>
</html>
