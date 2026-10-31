
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Data Mahasiswa</title>
</head>

<frameset rows="55,*" frameborder="0" framespacing="0" border="0">
    <frame src="topbar.php" name="topbar" noresize scrolling="no">

    <frameset cols="240,*" frameborder="0" framespacing="0" border="0">
        <frame src="menu_kiri.php" name="menu" noresize scrolling="auto">
        <frame src="welcome.php" name="welcome" noresize scrolling="auto">
    </frameset>
</frameset>

</html>
