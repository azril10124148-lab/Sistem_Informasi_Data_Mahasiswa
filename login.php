<?php
session_start();
include "koneksi.php";
$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $error = "Username dan password wajib diisi.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT username, password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($hasil)) {
            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['username'] = $user['username'];
                if (!isset($_SESSION['bahasa'])) {
                    $_SESSION['bahasa'] = 'id';
                }
                header("Location: index.php");
                exit;
            }
        }
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
<div class="login-box">
    <h1>LOGIN ADMIN</h1>
    <hr>
    <?php if ($error != "") { echo "<div class='pesan'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</div>"; } ?>
    <form method="post" action="">
        <div class="baris"><label>Username</label>
        <input type="text" name="username" required></div>

        <div class="baris"><label>Password</label>
        <input type="password" name="password" required></div>

        <input type="submit" name="login" value="LOGIN" class="btn">
    </form>
</div>
</body>
</html>
