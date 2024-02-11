<?php
    require("connection.inc.php");
    require("functions.inc.php");
    if(isset($_SESSION["ADMIN_LOGIN"]) && isset($_SESSION["ADMIN_EMAIL"]) != ''){
        
    }
    else{
        header('location:login.php');
        die();
    }
?>