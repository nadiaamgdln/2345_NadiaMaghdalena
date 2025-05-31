<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $isEdit ? __('Edit Pendaftaran Magang') : __('Form Pendaftaran Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops! Ada yang salah:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pendaftaran-magang.store') }}">
                        @csrf
                        <!-- Jika mode edit, tambahkan method PUT (walaupun form tetap POST) -->
                        {{-- @if($isEdit)
                            @method('PUT') // Kita pakai updateOrCreate, jadi tidak perlu PUT eksplisit di route
                        @endif --}}

                        <!-- Nama Mahasiswa (Otomatis) -->
                        <div class="mb-4">
                            <x-input-label for="nama_mahasiswa" :value="__('Nama Mahasiswa')" />
                            <x-text-input id="nama_mahasiswa" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="nama_mahasiswa" :value="$user->name" readonly />
                        </div>

                        <!-- NPM (Otomatis) -->
                        <div class="mb-4">
                            <x-input-label for="npm" :value="__('NPM')" />
                            <x-text-input id="npm" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="npm" :value="$user->npm" readonly />
                        </div>

                        <!-- Jurusan (Otomatis) -->
                        <div class="mb-4">
                            <x-input-label for="jurusan" :value="__('Jurusan')" />
                            <x-text-input id="jurusan" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="jurusan" :value="$user->jurusan" readonly />
                        </div>

                        <!-- Semester ke- -->
                        <div class="mb-4">
                            <x-input-label for="semester_ke" :value="__('Semester ke-')" />
                            <x-text-input id="semester_ke" class="block mt-1 w-full" type="text" name="semester_ke" :value="old('semester_ke', $pendaftaran->semester_ke)" required />
                            <x-input-error :messages="$errors->get('semester_ke')" class="mt-2" />
                        </div>

                        <!-- Dosen Pembimbing (Dropdown) -->
                        <div class="mb-4">
                            <x-input-label for="dosen_pembimbing" :value="__('Dosen Pembimbing')" />
                            <select id="dosen_pembimbing" name="dosen_pembimbing" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosenPembimbingOptions as $dosen)
                                    <option value="{{ $dosen }}" {{ old('dosen_pembimbing', $pendaftaran->dosen_pembimbing) == $dosen ? 'selected' : '' }}>
                                        {{ $dosen }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('dosen_pembimbing')" class="mt-2" />
                        </div>

                        <!-- Instansi -->
                        <div class="mb-4">
                            <x-input-label for="instansi" :value="__('Instansi')" />
                            <x-text-input id="instansi" class="block mt-1 w-full" type="text" name="instansi" :value="old('instansi', $pendaftaran->instansi)" required />
                            <x-input-error :messages="$errors->get('instansi')" class="mt-2" />
                        </div>

                        <!-- Lokasi Magang -->
                        <div class="mb-4">
                            <x-input-label for="lokasi_magang" :value="__('Lokasi Magang')" />
                            <x-text-input id="lokasi_magang" class="block mt-1 w-full" type="text" name="lokasi_magang" :value="old('lokasi_magang', $pendaftaran->lokasi_magang)" required />
                            <x-input-error :messages="$errors->get('lokasi_magang')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ $isEdit ? __('Update Pendaftaran') : __('Simpan Pendaftaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>