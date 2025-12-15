 <header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass-effect bg-white/90 border-b border-gray-200/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center text-white text-xl lg:text-2xl group-hover:scale-110 transition-transform duration-300">
                            🌾
                        </div>
                        <h1 class="text-xl lg:text-2xl font-bold gradient-text">DANA UMKM DESA</h1>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="menu-toggle" class="w-10 h-10 flex items-center justify-center text-gray-700 hover:text-primary transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <ul class="flex items-center space-x-8">
                        <li><a href="#beranda" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Beranda
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a href="#program" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Program
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a href="#proses" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Proses
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a href="#testimoni" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Testimoni
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a href="#kontak" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Kontak
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                    </ul>
                    
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-primary hover:text-secondary font-medium transition-colors duration-300">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-primary hover:text-secondary font-medium transition-colors duration-300">
                                        Keluar
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="px-6 py-2.5 bg-primary hover:bg-secondary text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    Masuk
                                </a>
                                <a href="{{ route('login') }}" class="px-6 py-2.5 bg-gradient-to-r from-primary to-accent hover:from-secondary hover:to-primary text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    Ajukan
                                </a>
                            @endauth
                        @endif
                    </div>
                </nav>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobile-nav" class="lg:hidden hidden bg-white border-t border-gray-200 py-4">
                <ul class="space-y-4">
                    <li><a href="#beranda" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Beranda</a></li>
                    <li><a href="#program" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Program</a></li>
                    <li><a href="#proses" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Proses</a></li>
                    <li><a href="#testimoni" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Testimoni</a></li>
                    <li><a href="#kontak" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Kontak</a></li>
                </ul>
                
                <div class="mt-6 px-4 space-y-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block w-full px-4 py-2.5 text-center bg-gray-100 text-primary font-medium rounded-lg hover:bg-gray-200 transition-colors duration-300">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2.5 text-center bg-primary text-white font-medium rounded-lg hover:bg-secondary transition-colors duration-300">
                                    Keluar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full px-4 py-2.5 text-center bg-gray-100 text-primary font-medium rounded-lg hover:bg-gray-200 transition-colors duration-300">Masuk</a>
                            <a href="{{ route('login') }}" class="block w-full px-4 py-2.5 text-center bg-gradient-to-r from-primary to-accent text-white font-medium rounded-lg hover:from-secondary hover:to-primary transition-all duration-300">Ajukan Sekarang</a>
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>
