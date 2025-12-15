<header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass-effect bg-white/90 border-b border-gray-200/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center text-white text-xl lg:text-2xl group-hover:scale-110 transition-transform duration-300">
                        🌾
                    </div>
                    <h1 class="text-xl lg:text-2xl font-bold gradient-text">DANA UMKM DESA</h1>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <ul class="flex items-center space-x-8">                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                                Admin Dashboard
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </li>
                    @elseif(Auth::check())
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                                Beranda
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('pinjaman.create') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Ajukan Pinjaman
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#program" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Program
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('status') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300 relative group">
                            Status
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                        </a>
                    </li>
                </ul>                <!-- User Menu -->
                @auth
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-lg hover:from-secondary hover:to-primary transition-all duration-300">
                        {{ Auth::user()->name }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                @else
                <div class="relative">
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-lg hover:from-secondary hover:to-primary transition-all duration-300">
                        Login
                    </a>
                @endauth

                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-300">
                            Profil
                        </a>
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-300">
                                Admin Dashboard
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-300">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="menu-toggle" class="w-10 h-10 flex items-center justify-center text-gray-700 hover:text-primary transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <nav id="mobile-nav" class="lg:hidden hidden bg-white border-t border-gray-200 py-4">
            <ul class="space-y-4">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Admin Dashboard</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Beranda</a></li>
                @endif
                <li><a href="{{ route('pinjaman.create') }}" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Ajukan Pinjaman</a></li>
                <li><a href="#program" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Program</a></li>
                <li><a href="{{ url('status') }}" class="block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors duration-300">Status</a></li>
            </ul>
        </nav>
    </div>
</header>

<script>
    // Mobile menu toggle
    const menuToggle = document.getElementById('menu-toggle');
    const mobileNav = document.getElementById('mobile-nav');

    menuToggle?.addEventListener('click', () => {
        mobileNav?.classList.toggle('hidden');
    });

    // Header background on scroll
    window.addEventListener('scroll', () => {
        const header = document.getElementById('header');
        if (window.scrollY > 100) {
            header?.classList.add('bg-white/95');
            header?.classList.remove('bg-white/90');
        } else {
            header?.classList.add('bg-white/90');
            header?.classList.remove('bg-white/95');
        }
    });

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown?.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdownButton = document.querySelector('button[onclick="toggleDropdown()"]');
        const dropdownMenu = document.getElementById('dropdown');

        if (!dropdownButton?.contains(event.target) && !dropdownMenu?.contains(event.target)) {
            dropdownMenu?.classList.add('hidden');
        }
    });
</script>
    });
</script>
