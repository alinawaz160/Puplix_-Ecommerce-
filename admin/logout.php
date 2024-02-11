<?php
    session_start();
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_EMAIL']);
    unset($_SESSION['USER_LOGIN']);
    unset($_SESSION['USER_ID']);
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    header("location:/puplix");
?>