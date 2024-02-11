<?php
require("admin/connection.inc.php");
require("admin/functions.inc.php");
$name = get_safe_value($con ,$_POST['name']);
$email = get_safe_value($con ,$_POST['email']);
$phone = get_safe_value($con ,$_POST['phone']);
$message = get_safe_value($con ,$_POST['message']);

$insert_contact_sql = "INSERT INTO contact(name,email,phone,message) values ('$name','$email','$phone','$message')";
$insert_contact_res = mysqli_query($con, $insert_contact_sql);
if ($insert_contact_res) {
    echo "Thank you.";
} else {
    echo "Error submitting form";
}