<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Laporan Magang - Minggu ke-') . $laporanMagang->minggu_ke }}
            </h2>
            <div>
                <a href="{{ route('laporan-magang.edit', $laporanMagang) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                    ✏ Edit
                </a>
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-laporan-deletion-{{ $laporanMagang->id }}')" class="ms-2 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    🗑 Hapus
                </button>

                <x-modal name="confirm-laporan-deletion-{{ $laporanMagang->id }}" focusable>
                    <form method="post" action="{{ route('laporan-magang.destroy', $laporanMagang) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Apakah Anda yakin ingin menghapus laporan ini?') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Laporan untuk <strong>Minggu ke-{{ $laporanMagang->minggu_ke }} ({{ $laporanMagang->judul }})</strong> akan dihapus permanen.
                        </p>
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-secondary-button>
                            <x-danger-button class="ms-3">
                                {{ __('Hapus Laporan') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <nav class="mb-4 text-sm" aria-label="Breadcrumb">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Dashboard</a>
                                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                            </li>
                            <li class="flex items-center">
                                <span class="text-gray-500 dark:text-gray-400">Laporan</span>
                                 <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                            </li>
                            <li>
                                <span class="text-gray-700 dark:text-gray-200">Detail - Minggu ke-{{ $laporanMagang->minggu_ke }}</span>
                            </li>
                        </ol>
                    </nav>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">{{ $laporanMagang->judul }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Minggu ke-{{ $laporanMagang->minggu_ke }} | Tanggal: {{ \Carbon\Carbon::parse($laporanMagang->tanggal_laporan)->isoFormat('D MMMM YYYY') }}</p>
                    </div>

                    <div class="prose dark:prose-invert max-w-none">
                        <h4 class="font-medium">Deskripsi Singkat:</h4>
                        <p>{{ $laporanMagang->deskripsi_singkat }}</p>
                    </div>

                    @if($laporanMagang->file_laporan_path)
                        <div class="mt-6">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">File Laporan Terlampir:</h4>
                            <a href="{{ Storage::url($laporanMagang->file_laporan_path) }}" target="_blank"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                    <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                </svg>
                                Download File ({{ basename($laporanMagang->file_laporan_path) }})
                            </a>
                        </div>
                    @else
                        <p class="mt-6 text-gray-500 dark:text-gray-400">Tidak ada file laporan yang terlampir.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>