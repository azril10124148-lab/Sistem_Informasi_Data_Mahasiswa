<?php
include "cek_login.php";
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: form_input_mahasiswa.php");
    exit;
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$fakultas = trim($_POST['fakultas'] ?? '');
$jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

// Simpan isian supaya tidak hilang saat kembali ke form
$_SESSION['old'] = $_POST;

function kembali($pesan) {
    $_SESSION['flash_error'] = $pesan;
    header("Location: form_input_mahasiswa.php");
    exit;
}

if ($nim == '' || $nama == '' || $prodi == '' || $fakultas == '' ||
    $jenis_kelamin == '' || $alamat == '' || $no_hp == '' || $email == '') {
    kembali("Semua kolom wajib diisi.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    kembali("Format email tidak valid.");
}

// Cek NIM sudah dipakai atau belum
$cek = mysqli_prepare($conn, "SELECT nama FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($cek, "s", $nim);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    kembali("NIM $nim sudah terdaftar. Gunakan NIM yang berbeda.");
}

// Simpan data
try {
    $stmt = mysqli_prepare($conn, "INSERT INTO mahasiswa (nim,nama,prodi,fakultas,jenis_kelamin,alamat,no_hp,email) VALUES (?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssssssss", $nim, $nama, $prodi, $fakultas, $jenis_kelamin, $alamat, $no_hp, $email);
    mysqli_stmt_execute($stmt);
} catch (mysqli_sql_exception $e) {
    kembali("Data gagal disimpan. Silakan coba lagi.");
}

unset($_SESSION['old']);
header("Location: tampil_mahasiswa.php");
exit;
?>