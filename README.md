# 📘 Aplikasi Manajemen Pelaporan Magang

**Nama:** \Nadia Maghdalena
**NIM:** \2308107010045

##  Deskripsi Singkat

Aplikasi ini merupakan sistem manajemen pelaporan magang berbasis web menggunakan Laravel Breeze. Mahasiswa dapat mendaftar magang, mengisi laporan mingguan, serta melihat histori laporan mereka. Aplikasi ini membantu proses pelaporan dan pemantauan magang menjadi lebih mudah, rapi, dan efisien.

##  Penjelasan Kode & Antarmuka

###  Autentikasi (Register & Login)

* **Register:** Mahasiswa mengisi nama, email, NPM, jurusan, dan password.
* **Login:** Menggunakan NPM dan password.
* Setelah login berhasil, pengguna akan diarahkan ke halaman dashboard mahasiswa.

###  Dashboard Mahasiswa

* Menampilkan informasi pribadi dan tabel laporan.
* Navigasi: Daftar Laporan, Tambah Laporan, Daftar Magang (jika belum), Profil, Logout.

###  Daftar Magang

* Mahasiswa wajib mengisi form pendaftaran magang setelah register.
* Form hanya bisa diedit, tidak bisa mengisi ulang.

###  Laporan Magang

* Tambah laporan per minggu (judul, deskripsi, isi lengkap, tanggal).
* Lihat detail laporan.
* Edit dan hapus laporan (dengan modal konfirmasi).

###  Profil

* Menampilkan data akun dari proses registrasi.
* Bisa edit informasi akun.

##  Teknologi yang Digunakan

* **Laravel Breeze** (autentikasi ringan dan siap pakai)
* **Tailwind CSS** (untuk tampilan antarmuka modern dan responsif)
* **Blade Components** (seperti `<x-input-label>`, `<x-text-input>`, dll)

---

##  Cara Instalasi Aplikasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/username/nama-project.git
   cd nama-project
   ```

2. **Install Dependency**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Buat File `.env`**

   ```bash
   cp .env.example .env
   ```

4. **Generate App Key**

   ```bash
   php artisan key:generate
   ```

5. **Setting Database**

   * Buka file `.env`
   * Isi konfigurasi database seperti:

     ```
     DB_DATABASE=magang_db
     DB_USERNAME=root
     DB_PASSWORD=
     ```

6. **Migrasi dan Seed Database**

   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Aplikasi**

   ```bash
   php artisan serve
   ```

   Akses di browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)
