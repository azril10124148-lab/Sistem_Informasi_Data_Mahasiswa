<?php
include "cek_login.php";
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: tampil_mahasiswa.php");
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

if ($nim == '' || $nama == '' || $prodi == '' || $fakultas == '' ||
    $jenis_kelamin == '' || $alamat == '' || $no_hp == '' || $email == '') {
    die("Semua kolom wajib diisi.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Format email tidak valid.");
}

$stmt = mysqli_prepare($conn, "UPDATE mahasiswa SET nama=?, prodi=?, fakultas=?, jenis_kelamin=?, alamat=?, no_hp=?, email=? WHERE nim=?");
mysqli_stmt_bind_param($stmt, "ssssssss", $nama, $prodi, $fakultas, $jenis_kelamin, $alamat, $no_hp, $email, $nim);

if (mysqli_stmt_execute($stmt)) {
    header("Location: tampil_mahasiswa.php");
    exit;
} else {
    echo "Data gagal diperbarui.";
}
?>
