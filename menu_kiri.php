
<?php
include "cek_login.php";
include "bahasa.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu</title>

    <link rel="stylesheet" href="style.css">
</head>

<body class="sidebar">

    <h2>MENU</h2>
    <hr>

    <div class="menu">
    <a href="welcome.php" target="welcome" data-page="beranda">
        <?php echo kata("Beranda", "Home"); ?>
    </a>

    <a href="form_input_mahasiswa.php" target="welcome" data-page="input">
        <?php echo kata("Input Data Mahasiswa", "Add Student"); ?>
    </a>

    <a href="tampil_mahasiswa.php" target="welcome" data-page="tampil">
        <?php echo kata("Tampil Data Mahasiswa", "View Students"); ?>
    </a>
</div>

    <div class="bawah">
        <hr>

        <p>
            <?php echo kata("Login sebagai", "Logged in as"); ?><br>
            <b><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></b>
        </p>

        <a href="logout.php" target="_top" class="logout">
            <?php echo kata("Keluar", "Logout"); ?>
        </a>
    </div>

<hr>

<script>
function setAktif(nama) {
    document.querySelectorAll('.menu a').forEach(function (a) {
        a.classList.toggle('aktif', a.dataset.page === nama);
    });
}
setAktif('beranda'); // halaman awal
</script>

</body>
</html>
