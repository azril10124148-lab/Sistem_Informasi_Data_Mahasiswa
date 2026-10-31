<?php
include "cek_login.php";
include "bahasa.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Topbar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="topbar">
    <div class="judul-app">
        <?php echo kata("Sistem Informasi Data Mahasiswa", "Student Information System"); ?>
    </div>

    <form action="ganti_bahasa.php" method="post" target="_top" class="form-bahasa-top">
        <label><?php echo kata("Bahasa", "Language"); ?>:</label>
        <select name="bahasa" onchange="this.form.submit()">
            <option value="id" <?php if ($_SESSION['bahasa']=='id') echo 'selected'; ?>>Bahasa Indonesia</option>
            <option value="en" <?php if ($_SESSION['bahasa']=='en') echo 'selected'; ?>>English</option>
        </select>
    </form>
</body>
</html>