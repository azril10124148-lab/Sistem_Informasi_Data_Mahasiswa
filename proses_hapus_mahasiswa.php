<?php
include "cek_login.php";
include "koneksi.php";

$nim = $_GET['nim'] ?? '';

if ($nim == '') {
    header("Location: tampil_mahasiswa.php");
    exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($stmt, "s", $nim);

if (mysqli_stmt_execute($stmt)) {
    header("Location: tampil_mahasiswa.php");
    exit;
} else {
    echo "Data gagal dihapus.";
}
?>
