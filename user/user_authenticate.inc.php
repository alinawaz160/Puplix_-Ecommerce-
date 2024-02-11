<?php
    require("../admin/connection.inc.php");
    // require("../admin/functions.inc.php");
    if(isset($_SESSION["USER_LOGIN"]) && isset($_SESSION["USER_EMAIL"]) != ''){
        
    }
    else{
        header('location:/puplix/register.php');
        die();
    }
?>