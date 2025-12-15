<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UMKM Desa - Peminjaman Dana</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a',
                        secondary: '#15803d',
                        accent: '#22c55e',
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'fade-in-down': 'fadeInDown 0.6s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS for animations -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
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
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(22, 163, 74, 0.1) 0%, transparent 50%);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
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
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center hero-pattern" id="beranda" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('/images/hero1.jpg') no-repeat center center; background-size: cover;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 animate-fade-in-down">
                    Dukung <span class="text-accent">UMKM Desa</span>, 
                    <br class="hidden sm:block">Bangkitkan Ekonomi Lokal
                </h2>
                <p class="text-lg sm:text-xl text-gray-200 mb-8 max-w-3xl mx-auto animate-fade-in-up">
                    Solusi pembiayaan dan pendampingan untuk membantu usaha mikro, kecil, dan menengah di desa Anda berkembang dan mencapai potensi maksimal dengan proses yang mudah dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-accent hover:from-secondary hover:to-primary text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-2xl hover:scale-105 transform">
                        Ajukan Pinjaman Sekarang
                    </a>
                    <a href="#program" class="w-full sm:w-auto px-8 py-4 bg-white/10 glass-effect hover:bg-white/20 text-white font-semibold rounded-xl border border-white/30 transition-all duration-300 hover:shadow-2xl hover:scale-105 transform">
                        Pelajari Program
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div id="scroll-down" class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center animate-bounce-slow cursor-pointer">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse-slow"></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white" id="program">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Program <span class="gradient-text">Pinjaman Kami</span>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami menawarkan berbagai program pembiayaan yang dirancang khusus untuk kebutuhan UMKM di desa dengan suku bunga rendah dan proses yang mudah.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        💰
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pinjaman Modal Usaha</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Pinjaman untuk modal kerja, pengembangan usaha, atau memulai usaha baru dengan suku bunga rendah mulai dari 3% per tahun dan tenor hingga 36 bulan.
                    </p>
                    <div class="flex items-center text-primary font-semibold group-hover:text-secondary transition-colors duration-300">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        🛠️
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pembiayaan Alat Produksi</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Dana khusus untuk pembelian peralatan, mesin, atau teknologi yang dibutuhkan untuk meningkatkan kapasitas dan kualitas produksi usaha Anda.
                    </p>
                    <div class="flex items-center text-primary font-semibold group-hover:text-secondary transition-colors duration-300">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 md:col-span-2 lg:col-span-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        🌱
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Dana Pertanian & Peternakan</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Program pembiayaan khusus untuk petani, peternak, dan usaha pengolahan hasil pertanian dengan jadwal pembayaran yang disesuaikan dengan masa panen.
                    </p>
                    <div class="flex items-center text-primary font-semibold group-hover:text-secondary transition-colors duration-300">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-gradient-to-br from-primary/5 to-accent/5" id="proses">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Proses <span class="gradient-text">Pengajuan</span>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Proses pengajuan pinjaman yang mudah, cepat, dan transparan dalam 4 langkah sederhana.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            1
                        </div>
                        <div class="hidden lg:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-primary/50 to-transparent"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar Online</h3>
                    <p class="text-gray-600">Isi formulir pendaftaran online dengan data lengkap dan dokumen yang diperlukan.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            2
                        </div>
                        <div class="hidden lg:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-primary/50 to-transparent"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Verifikasi Data</h3>
                    <p class="text-gray-600">Tim kami akan memverifikasi data dan dokumen yang Anda submit dalam 1-2 hari kerja.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            3
                        </div>
                        <div class="hidden lg:block absolute top-10 left-full w-full h-0.5 bg-gradient-to-r from-primary/50 to-transparent"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Survei Lapangan</h3>
                    <p class="text-gray-600">Petugas akan melakukan survei ke lokasi usaha untuk penilaian kelayakan.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencairan Dana</h3>
                    <p class="text-gray-600">Setelah disetujui, dana akan dicairkan langsung ke rekening Anda.</p>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Statistics Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Statistik <span class="gradient-text">Pengajuan</span>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Penyebaran pengajuan yang telah disetujui berdasarkan dusun.
                </p>
            </div>
            
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                    <div class="text-gray-700 font-medium mb-4">Statistik Pengajuan per Dusun</div>
                    <div class="relative" style="height: 400px; width: 100%;">
                        <canvas id="statistikChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Apa Kata Mereka <span class="gradient-text">Tentang Kami</span>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Testimoni dari para pelaku UMKM yang telah merasakan manfaat dari program kami.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow p-8 flex flex-col items-start">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mr-3">A</div>
                        <div>
                            <div class="font-semibold text-gray-900">Ahmad Fauzi</div>
                            <div class="text-xs text-gray-500">Pemilik Toko Oleh Oleh</div>
                        </div>
                    </div>
                    <div class="text-gray-700 mb-4">"Program pinjaman modal usaha sangat membantu saya dalam mengembangkan toko oleh-oleh khas daerah. Prosesnya cepat dan mudah, serta bunganya yang rendah membuat saya terbantu sekali."</div>
                    <div class="flex text-yellow-400 text-lg">★★★★★</div>
                </div>
                <div class="bg-white rounded-2xl shadow p-8 flex flex-col items-start">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mr-3">S</div>
                        <div>
                            <div class="font-semibold text-gray-900">Siti Aminah</div>
                            <div class="text-xs text-gray-500">Petani Sayur Organik</div>
                        </div>
                    </div>
                    <div class="text-gray-700 mb-4">"Saya sangat terbantu dengan adanya program pembiayaan alat produksi ini. Kini saya bisa membeli alat pertanian modern yang mempercepat proses panen dan meningkatkan kualitas sayur saya."</div>
                    <div class="flex text-yellow-400 text-lg">★★★★★</div>
                </div>
                <div class="bg-white rounded-2xl shadow p-8 flex flex-col items-start">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mr-3">R</div>
                        <div>
                            <div class="font-semibold text-gray-900">Rudi Hartono</div>
                            <div class="text-xs text-gray-500">Pengusaha Kecil</div>
                        </div>
                    </div>
                    <div class="text-gray-700 mb-4">"Proses pengajuan pinjaman di DANA UMKM DESA sangat transparan dan cepat. Saya hanya perlu menunggu 2 hari kerja untuk mendapatkan kepastian. Sangat memuaskan!"</div>
                    <div class="flex text-yellow-400 text-lg">★★★★★</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-green-500">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">Siap Mengembangkan Usaha Anda?</h2>
            <p class="text-lg sm:text-xl text-white/90 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan UMKM yang telah merasakan manfaat program pembiayaan kami.</p>
            <a href="{{ route('login') }}" class="inline-block px-8 py-4 bg-white text-green-600 font-semibold rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300 text-lg">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Chart Data -->
    <script>
        window.chartData = {!! json_encode([
            'labels' => $pengajuanByDusun->pluck('dusun')->map(fn($dusun) => "Dusun {$dusun}"),
            'data' => $pengajuanByDusun->pluck('total')
        ]) !!};
    </script>

    <!-- Chart Initialization -->
    <script>
        // Create bar chart for approved applications per dusun
        const statistikCtx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(statistikCtx, {
            type: 'bar',
            data: {
                labels: window.chartData.labels,
                datasets: [{
                    label: 'Jumlah Pengajuan Disetujui',
                    data: window.chartData.data,
                    backgroundColor: '#22c55e',
                    borderColor: '#16a34a',
                    borderWidth: 1,
                    borderRadius: 8,
                    maxBarThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 5,
                        bottom: 5,
                        left: 5,
                        right: 5
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                animation: {
                    duration: 500
                }
            }
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileNav = document.getElementById('mobile-nav');

        menuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header background on scroll
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('bg-white/95');
                header.classList.remove('bg-white/90');
            } else {
                header.classList.add('bg-white/90');
                header.classList.remove('bg-white/95');
            }
        });

        // Scroll down indicator
        document.getElementById('scroll-down').addEventListener('click', () => {
            document.getElementById('program').scrollIntoView({
                behavior: 'smooth'
            });
        });

        // Chart.js for monthly applications and status distribution
        const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
        const statusCtx = document.getElementById('statusChart').getContext('2d');

        // Monthly Applications Chart
        const applicationsChart = new Chart(applicationsCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: {!! json_encode($monthlyData) !!},
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: '#22c55e',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                animation: {
                    duration: 500
                }
            }
        });

        // Status Distribution Chart (Doughnut)
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Pending', 'Ditolak'],
                datasets: [{
                    label: 'Status Pengajuan',
                    data: [
                        {{ $statusCounts['approved'] }},
                        {{ $statusCounts['pending'] }},
                        {{ $statusCounts['rejected'] }}
                    ],
                    backgroundColor: [
                        '#22c55e',
                        '#f59e0b',
                        '#ef4444'
                    ],
                    borderWidth: 1,
                    borderColor: '#fff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                animation: {
                    duration: 500
                }
            }
        });
    </script>
</body>
</html>