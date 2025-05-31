<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pesan Sukses/Warning dari Redirect -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('warning'))
                <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif
             @if (session('error_message')) <!-- Untuk error hapus laporan -->
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error_message') }}</span>
                </div>
            @endif


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-lg font-medium mb-2">Informasi Pribadi</h3>
                    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>NPM:</strong> {{ Auth::user()->npm }}</p>
                    <p><strong>Jurusan:</strong> {{ Auth::user()->jurusan }}</p>
                    @if(Auth::user()->pendaftaranMagang)
                        <p><strong>Lokasi Magang:</strong> {{ Auth::user()->pendaftaranMagang->lokasi_magang }}</p>
                        <p><strong>Instansi:</strong> {{ Auth::user()->pendaftaranMagang->instansi }}</p>
                        <p><strong>Dosen Pembimbing:</strong> {{ Auth::user()->pendaftaranMagang->dosen_pembimbing }}</p>
                    @else
                        <p class="mt-2 text-yellow-600 dark:text-yellow-400">
                            Anda belum melengkapi data pendaftaran magang.
                            <a href="{{ route('pendaftaran-magang.form') }}" class="underline hover:text-yellow-800 dark:hover:text-yellow-200">
                                Lengkapi sekarang.
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Daftar Laporan Magang</h3>
                        @if(Auth::user()->pendaftaranMagang)
                            <a href="{{ route('laporan-magang.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                ➕ Tambah Laporan
                            </a>
                        @else
                            <span class="text-sm text-gray-500">Isi Pendaftaran Magang untuk menambah laporan.</span>
                        @endif
                    </div>

                    @if(Auth::user()->pendaftaranMagang && Auth::user()->laporanMagangs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Minggu ke-</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deskripsi Singkat</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach (Auth::user()->laporanMagangs()->orderBy('minggu_ke')->get() as $index => $laporan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $laporan->minggu_ke }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $laporan->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ Str::limit($laporan->deskripsi_singkat, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->isoFormat('D MMMM YYYY') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('laporan-magang.show', $laporan) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">🔍 Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif(Auth::user()->pendaftaranMagang)
                        <p>Belum ada laporan magang. Silakan <a href="{{ route('laporan-magang.create') }}" class="underline text-indigo-600 hover:text-indigo-800">tambah laporan baru</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>