@csrf
<div class="mb-4">
    <x-input-label for="minggu_ke" :value="__('Minggu ke-')" />
    <x-text-input id="minggu_ke" class="block mt-1 w-full" type="number" name="minggu_ke" :value="old('minggu_ke', $laporanMagang->minggu_ke)" required min="1" />
    <x-input-error :messages="$errors->get('minggu_ke')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="judul" :value="__('Judul Laporan')" />
    <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $laporanMagang->judul)" required />
    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="deskripsi_singkat" :value="__('Deskripsi Singkat')" />
    <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('deskripsi_singkat', $laporanMagang->deskripsi_singkat) }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi_singkat')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="tanggal_laporan" :value="__('Tanggal Laporan')" />
    <x-text-input id="tanggal_laporan" class="block mt-1 w-full" type="date" name="tanggal_laporan" :value="old('tanggal_laporan', $laporanMagang->tanggal_laporan ? \Carbon\Carbon::parse($laporanMagang->tanggal_laporan)->format('Y-m-d') : '')" required />
    <x-input-error :messages="$errors->get('tanggal_laporan')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="file_laporan" :value="__('Upload File Laporan (PDF, DOC, DOCX, ZIP, RAR - maks 10MB)')" />
    <input id="file_laporan" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="file_laporan">
    <x-input-error :messages="$errors->get('file_laporan')" class="mt-2" />
    @if(isset($laporanMagang) && $laporanMagang->file_laporan_path)
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            File saat ini: <a href="{{ Storage::url($laporanMagang->file_laporan_path) }}" target="_blank" class="underline hover:text-indigo-500">{{ basename($laporanMagang->file_laporan_path) }}</a>
        </p>
    @endif
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 me-4">
        Batal
    </a>
    <x-primary-button>
        {{ $tombolSubmit ?? 'Simpan' }}
    </x-primary-button>
</div>