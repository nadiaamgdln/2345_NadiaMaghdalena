<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Menggunakan locale Laravel --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Internify - Manajemen Pelaporan Magang</title> {{-- Judul disesuaikan --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net"> {{-- Bisa dihapus jika tidak menggunakan bunny.net --}}
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS dari CDN (sesuai referensi Anda) -->
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- Style CSS dari referensi Anda --}}
        <style>
            body {
                font-family: 'Raleway', sans-serif;
            }
            /* Custom animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(249, 177, 122, 0.3); }
                50% { box-shadow: 0 0 40px rgba(249, 177, 122, 0.6); }
            }
            @keyframes slideInFromLeft {
                0% { transform: translateX(-100%); opacity: 0; }
                100% { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideInFromRight {
                0% { transform: translateX(100%); opacity: 0; }
                100% { transform: translateX(0); opacity: 1; }
            }
            @keyframes fadeInUp {
                0% { transform: translateY(30px); opacity: 0; }
                100% { transform: translateY(0); opacity: 1; }
            }
            @keyframes scaleIn {
                0% { transform: scale(0.8); opacity: 0; }
                100% { transform: scale(1); opacity: 1; }
            }
            .hero-gradient {
                background: linear-gradient(135deg, #2d3250 0%, #424769 100%);
            }
            .btn-primary {
                background: linear-gradient(135deg, #f9b17a 0%, #e09a60 100%);
                color: #1b1b18;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            .btn-primary::before {
                content: ''; position: absolute; top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.5s;
            }
            .btn-primary:hover::before { left: 100%; }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(249, 177, 122, 0.4);
            }
            .btn-secondary {
                border: 2px solid #f9b17a; color: #f9b17a;
                transition: all 0.3s ease; position: relative; overflow: hidden;
            }
            .btn-secondary::before {
                content: ''; position: absolute; top: 0; left: 0;
                width: 0; height: 100%; background-color: #f9b17a;
                transition: width 0.3s ease; z-index: -1;
            }
            .btn-secondary:hover::before { width: 100%; }
            .btn-secondary:hover { color: #1b1b18; transform: translateY(-2px); }
            .feature-card {
                background: rgba(45, 50, 80, 0.3); backdrop-filter: blur(10px);
                border: 1px solid rgba(249, 177, 122, 0.2); transition: all 0.3s ease;
            }
            .feature-card:hover {
                background: rgba(45, 50, 80, 0.5); border-color: rgba(249, 177, 122, 0.5);
                transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }
            .feature-icon { transition: all 0.3s ease; }
            .feature-card:hover .feature-icon {
                transform: scale(1.1) rotate(5deg); animation: pulse-glow 2s infinite;
            }
            .floating-element { animation: float 6s ease-in-out infinite; }
            .slide-in-left { animation: slideInFromLeft 1s ease-out; }
            .slide-in-right { animation: slideInFromRight 1s ease-out; }
            .fade-in-up { animation: fadeInUp 1s ease-out; }
            .scale-in { animation: scaleIn 1s ease-out; }
            .text-gradient {
                background: linear-gradient(135deg, #f9b17a 0%, #676f9d 100%);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .glassmorphism {
                background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .nav-link { position: relative; transition: all 0.3s ease; }
            .nav-link::after {
                content: ''; position: absolute; bottom: -2px; left: 0;
                width: 0; height: 2px; background-color: #f9b17a;
                transition: width 0.3s ease;
            }
            .nav-link:hover::after { width: 100%; }
            .parallax-bg {
                background-attachment: fixed; background-position: center;
                background-repeat: no-repeat; background-size: cover;
            }
            html { scroll-behavior: smooth; }
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #0A192F; }
            ::-webkit-scrollbar-thumb { background: #f9b17a; border-radius: 4px; }
            ::-webkit-scrollbar-thumb:hover { background: #e09a60; }
        </style>
    </head>
    <body class="antialiased text-slate-800 dark:text-slate-200"> {{-- Kelas dark:text-slate-200 mungkin tidak relevan jika semua teks putih --}}
        <div class="min-h-screen bg-[#0A192F] text-white overflow-x-hidden">
            <!-- Header dari kode pertama -->
            <header class="absolute inset-x-0 top-0 z-50 glassmorphism">
                <nav class="flex items-center justify-between p-6 lg:px-8 slide-in-left" aria-label="Global">
                    <div class="flex lg:flex-1">
                        <a href="{{ route('welcome') }}" class="-m-1.5 p-1.5 floating-element">
                            <span class="sr-only">Internify</span>
                            <h1 class="text-2xl font-semibold text-gradient">Internify</h1> {{-- Judul Aplikasi --}}
                        </a>
                    </div>
                    <div class="flex lg:flex-1 lg:justify-end space-x-4 slide-in-right">
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-md px-4 py-2 text-sm font-semibold btn-secondary nav-link">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-4 py-2 text-sm font-semibold text-white hover:text-[#f9b17a] transition-colors duration-300 nav-link">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-md px-4 py-2 text-sm font-semibold btn-primary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            </header>

            <!-- Hero Section -->
            <div class="relative isolate px-6 pt-32 lg:pt-40"> {{-- Mengurangi padding top agar header tidak terlalu jauh --}}
                <!-- Animated background elements -->
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#f9b17a] to-[#676f9d] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] floating-element" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>

                <div class="mx-auto max-w-3xl py-24 sm:py-32 lg:py-40"> {{-- Mengurangi padding vertikal hero --}}
                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl fade-in-up">
                            Manajemen Pelaporan Magang <span class="text-gradient">Lebih Mudah</span>
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-300 fade-in-up" style="animation-delay: 0.3s;">
                            Platform terpadu untuk mahasiswa dan dosen dalam mengelola dan memantau laporan kegiatan magang secara efisien dan transparan.
                        </p>
                        <div class="mt-10 flex items-center justify-center gap-x-6 scale-in" style="animation-delay: 0.6s;">
                            @guest
                                <a href="{{ route('register') }}" class="rounded-md btn-primary px-6 py-3 text-base font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f9b17a]">
                                    Daftar Sekarang
                                </a>
                                <a href="{{ route('login') }}" class="text-base font-semibold leading-6 text-white hover:text-[#f9b17a] transition-colors duration-300 nav-link">
                                    Sudah punya akun? <span aria-hidden="true">→</span>
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="rounded-md btn-primary px-6 py-3 text-base font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f9b17a]">
                                    Masuk ke Dashboard
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>

                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#676f9d] to-[#f9b17a] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem] floating-element" style="animation-delay: 2s; clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-12 sm:py-20 bg-[#0A192F] relative"> {{-- Pastikan background sama atau serasi --}}
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:text-center fade-in-up">
                        <h2 class="text-base font-semibold leading-7 text-[#f9b17a]">Fitur Unggulan</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Semua yang Anda Butuhkan untuk <span class="text-gradient">Pelaporan Magang</span>
                        </p>
                        <p class="mt-6 text-lg leading-8 text-gray-300">
                            Dari pendaftaran hingga pengumpulan laporan akhir, semua terintegrasi dalam satu platform.
                        </p>
                    </div>

                    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                            <div class="feature-card rounded-2xl p-8 fade-in-up" style="animation-delay: 0.2s;">
                                <dt class="text-base font-semibold leading-7 text-white flex items-center">
                                    <div class="feature-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-[#f9b17a] to-[#e09a60] mr-4">
                                        <svg class="h-6 w-6 text-[#0A192F]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </div>
                                    Pendaftaran Magang Online
                                </dt>
                                <dd class="mt-4 text-base leading-7 text-gray-300">Isi formulir pendaftaran magang dengan mudah dan data tersimpan aman.</dd>
                            </div>

                            <div class="feature-card rounded-2xl p-8 fade-in-up" style="animation-delay: 0.4s;">
                                <dt class="text-base font-semibold leading-7 text-white flex items-center">
                                    <div class="feature-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-[#f9b17a] to-[#e09a60] mr-4">
                                        <svg class="h-6 w-6 text-[#0A192F]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                        </svg>
                                    </div>
                                    Laporan Mingguan Terstruktur
                                </dt>
                                <dd class="mt-4 text-base leading-7 text-gray-300">Buat dan submit laporan mingguan kegiatan magang Anda langsung dari dashboard.</dd>
                            </div>

                            <div class="feature-card rounded-2xl p-8 fade-in-up" style="animation-delay: 0.6s;">
                                <dt class="text-base font-semibold leading-7 text-white flex items-center">
                                    <div class="feature-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-[#f9b17a] to-[#e09a60] mr-4">
                                        <svg class="h-6 w-6 text-[#0A192F]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h15.75c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 19.875v-6.75zM19.5 9.75v.75A2.25 2.25 0 0117.25 12h-1.5c-.363 0-.72-.063-1.065-.181M3 13.125c0-2.489 2.011-4.5 4.5-4.5h6.75A4.5 4.5 0 0118.75 13.5v.75" />
                                        </svg>
                                    </div>
                                    Monitoring oleh Dosen
                                </dt>
                                <dd class="mt-4 text-base leading-7 text-gray-300">(Jika ada role dosen) Dosen pembimbing dapat memantau progres dan memberikan feedback.</dd>
                            </div>

                            <div class="feature-card rounded-2xl p-8 fade-in-up" style="animation-delay: 0.8s;">
                                <dt class="text-base font-semibold leading-7 text-white flex items-center">
                                    <div class="feature-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-[#f9b17a] to-[#e09a60] mr-4">
                                        <svg class="h-6 w-6 text-[#0A192F]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </div>
                                    Unduh Laporan (PDF)
                                </dt>
                                <dd class="mt-4 text-base leading-7 text-gray-300">Cetak atau unduh data pendaftaran dan laporan mingguan dalam format PDF.</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Decorative elements -->
                <div class="absolute top-1/2 left-10 w-20 h-20 bg-gradient-to-r from-[#f9b17a] to-[#676f9d] rounded-full opacity-10 floating-element blur-sm -z-10" style="animation-delay: 1s;"></div>
                <div class="absolute bottom-20 right-10 w-16 h-16 bg-gradient-to-r from-[#676f9d] to-[#f9b17a] rounded-full opacity-10 floating-element blur-sm -z-10" style="animation-delay: 3s;"></div>
            </div>

            <!-- Footer -->
            <footer class="bg-[#081425] text-center py-8 relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-sm text-gray-400 fade-in-up">
                        © {{ date('Y') }} Internify. All rights reserved.
                    </p>
                    <p class="text-xs text-gray-500 mt-1 fade-in-up" style="animation-delay: 0.2s;">
                        Dibuat dengan <span class="text-[#f9b17a] animate-pulse">♥</span> menggunakan Laravel & Tailwind CSS
                    </p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#f9b17a] to-transparent opacity-50"></div>
            </footer>
        </div>

        {{-- JavaScript dari referensi Anda, disesuaikan --}}
        <script>
            const observerOptions = {
                threshold: 0.1, 
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) { 
                        entry.target.style.animationPlayState = 'running';
                    } else {
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in-up, .scale-in, .slide-in-left, .slide-in-right, .feature-card').forEach(el => {
                el.style.animationPlayState = 'paused'; 
                observer.observe(el);
            });
        </script>
    </body>
</html>