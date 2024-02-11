<?php
require("admin/connection.inc.php");
require("admin/functions.inc.php");

if (is_user_login()) {
    $user_id = get_user_from_session($con)['id'];
    $cart_id = '';
    $msg = '';
    $product_id = $_POST['product_id'];

    if ($product_id != '' && isset($product_id)) {
        $get_cart_details = get_user_cart_details($con, $user_id);
        foreach($get_cart_details as $list)
        if (isset($list)  && $list['product_id'] == $product_id) {
            $msg = "Product already exists in cart";
        }
        if ($msg == '') {
            $cart_id = get_cart_by_user_id($con , $user_id)['id'];
            $product = getProductById($con, $product_id);
            $insert_cart_detail_sql = "INSERT INTO cart_details (product_name, qty, price, cart_id, product_id) VALUES ('{$product['name']}', '1', '{$product['price']}', '$cart_id', '{$product['id']}')";
            $insert_cart_detail_res = mysqli_query($con, $insert_cart_detail_sql);
            if ($insert_cart_detail_res) {
                echo "Item added to Cart.";
            } else {
                echo "Error adding item to Cart: " . mysqli_error($con);
            }
        } else {
            echo $msg;
        }
    } else {
        echo "No product clicked.";
    }
} else {
    echo "User not logged in.";
}
