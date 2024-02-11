<?php
require("../admin/connection.inc.php");
require("../admin/functions.inc.php");
$user_id = get_user_from_session($con)['id'];
global $con, $user_id;
$get_cart_details = get_user_cart_details($con, $user_id);
$total_bill = 0;
$cart_id = null;
$total_qty = 0;
foreach ($get_cart_details as $list) {
    $total_bill = $total_bill + $list['price'];
    $total_qty = $total_qty + $list['qty'];
    $cart_id = $list['cart_id'];
}
$insert_order_sql = "INSERT INTO orders(user_id,status,is_completed,total_bill,total_qty) values ('$user_id','1','0','$total_bill','$total_qty');";
$insert_order_res = mysqli_query($con, $insert_order_sql);

$order_id = mysqli_insert_id($con);

foreach ($get_cart_details as $list) {
    $qty = $list['qty'];
    $price = $list['price'];
    $product_name = $list['product_name'];
    $insert_order_details_sql = "INSERT INTO order_details(qty,price,product_name ,order_id) values ('$qty','$price','$product_name','$order_id')";
    mysqli_query($con, $insert_order_details_sql);
}
if ($cart_id != null) {
    $delete_cart_details_sql = "DELETE from cart_details where cart_id ='$cart_id'";
    mysqli_query($con, $delete_cart_details_sql);
}
echo 'Order Placed';