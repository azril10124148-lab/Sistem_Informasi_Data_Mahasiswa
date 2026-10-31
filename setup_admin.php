<?php
include "koneksi.php";

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "Akun admin sudah tersedia. Username: admin";
} else {
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "Akun berhasil dibuat.<br>Username: admin<br>Password: admin123<br><b>Hapus file setup_admin.php setelah selesai.</b>";
    } else {
        echo "Gagal membuat akun admin.";
    }
}
?>
