<?php
session_start();

if (isset($_POST['bahasa'])) {
    if ($_POST['bahasa'] == 'id' || $_POST['bahasa'] == 'en') {
        $_SESSION['bahasa'] = $_POST['bahasa'];
    }
}
header("Location: index.php");
exit;
?>
