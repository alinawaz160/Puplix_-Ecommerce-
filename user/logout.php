<?php
    unset($_SESSION['USER_LOGIN']);
    unset($_SESSION['USER_ID']);
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    session_destroy();
    header("location:/puplix");
?>