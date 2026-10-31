<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['bahasa'])) {
    $_SESSION['bahasa'] = 'id';
}

function kata($id, $en) {
    if (isset($_SESSION['bahasa']) && $_SESSION['bahasa'] == 'en') {
        return $en;
    }
    return $id;
}
?>
