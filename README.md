# Sistem_Informasi_Data_Mahasiswa
Sistem Informasi Manajemen Data Mahasiswa berbasis PHP dan MySQL: CRUD, login session, dan dua bahasa (ID/EN).

# Sistem Informasi Manajemen Data Mahasiswa
Aplikasi web sederhana untuk mengelola data mahasiswa (tambah, tampil, ubah, hapus). Dibuat dengan PHP murni dan MySQL sebagai tugas mata kuliah **Penerapan Teknologi Internet**.

## Identitas

| | |
|---|---|
| Nama | Mohammad Azril R AT Musa |
| NIM | 10124148 |
| Program Studi | Teknik Informatika |
| Fakultas | Teknik dan Ilmu Komputer |
| Universitas | Universitas Komputer Indonesia |
| Dosen Pengampu | Donny Reza, M.Kom |

## Fitur

- Login dan logout menggunakan session
- Tambah data mahasiswa dengan validasi input dan pengecekan NIM ganda
- Tampil data mahasiswa dalam tabel, dengan fitur pencarian
- Ubah dan hapus data mahasiswa
- Beranda berisi ringkasan data (total mahasiswa, jumlah per jenis kelamin, jumlah per program studi)
- Pilihan bahasa Indonesia dan English menggunakan session
- Tampilan dengan CSS: menu samping dengan penanda menu aktif, tabel, dan form

## Teknologi

- PHP (tanpa framework)
- MySQL dengan ekstensi mysqli
- HTML dan CSS
- XAMPP sebagai server lokal

## Keamanan

- Password disimpan dalam bentuk hash (`password_hash` dan `password_verify`)
- Query memakai prepared statement untuk membantu mencegah SQL injection
- Output ditampilkan dengan `htmlspecialchars()` untuk mencegah XSS
- Halaman pengelolaan data dilindungi session login

## Cara Menjalankan

1. Salin folder proyek ke `C:\xampp\htdocs`.
2. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`, lalu impor file `database.sql`.
4. Buka `http://localhost/NAMA_FOLDER/setup_admin.php` untuk membuat akun admin, lalu hapus file `setup_admin.php`.
5. Buka `http://localhost/NAMA_FOLDER/` dan login.

Ganti `NAMA_FOLDER` dengan nama folder proyek di `htdocs`.

**Akun login**

- Username: `admin`
- Password: `admin123`

Pengaturan koneksi default ada di `koneksi.php`: host `localhost`, user `root`, password kosong, database `db_mahasiswa`. Sesuaikan jika konfigurasi MySQL berbeda.

## Struktur File

| File | Fungsi |
|---|---|
| `database.sql` | Skrip pembuatan database dan tabel |
| `koneksi.php` | Koneksi PHP ke database |
| `setup_admin.php` | Membuat akun admin awal |
| `login.php`, `logout.php`, `cek_login.php` | Login, logout, dan proteksi halaman |
| `bahasa.php`, `ganti_bahasa.php` | Pergantian bahasa dengan session |
| `index.php`, `topbar.php`, `menu_kiri.php` | Kerangka halaman utama dan menu |
| `welcome.php` | Beranda berisi ringkasan data |
| `form_input_mahasiswa.php`, `proses_save_mahasiswa.php` | Tambah data |
| `tampil_mahasiswa.php` | Tampil dan cari data |
| `form_edit_mahasiswa.php`, `proses_update_mahasiswa.php` | Ubah data |
| `proses_hapus_mahasiswa.php` | Hapus data |
| `style.css` | Seluruh tampilan aplikasi |

## Struktur Database

Database `db_mahasiswa` memiliki dua tabel.

**mahasiswa**: `nim` (primary key), `nama`, `prodi`, `fakultas`, `jenis_kelamin`, `alamat`, `no_hp`, `email`

**users**: `id` (primary key), `username` (unik), `password` (hash)
