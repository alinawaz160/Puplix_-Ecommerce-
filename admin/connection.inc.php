<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $con = mysqli_connect("localhost", "puplix", "isY7Irn9Wucx", "puplix");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>