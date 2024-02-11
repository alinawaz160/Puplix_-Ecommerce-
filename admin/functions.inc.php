<?php
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}
function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($con, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($con, $str);
    }
}

function get_products($con, $type = '', $limit = '', $categories_id = '')
{
    $sql = "SELECT * FROM product where status = '1'";

    if ($categories_id != "") {
        $sql .= " and categories_id = '$categories_id' ";
    }

    if ($type == "latest") {
        $sql .= "ORDER BY id DESC ";
    }

    if ($limit != "") {
        $sql .= "LIMIT $limit";
    }

    $res = mysqli_query($con, $sql);
    $data = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }

    return $data;
}

function get_user_cart_details($con, $user_id = '')
{
    if ($user_id != '') {
        $cart_details_sql = "select cart_details.*,user_cart.id as cart_id from cart_details,user_cart where cart_details.cart_id = user_cart.id and user_cart.user_id =  '$user_id'";
        $cart_details_res = mysqli_query($con, $cart_details_sql);
        $cart_details_data = array();
        while ($row = mysqli_fetch_assoc($cart_details_res)) {
            $cart_details_data[] = $row;
        }
        return $cart_details_data;
    }
}

function get_user_cart_detail_by_productId($con, $user_id = '',$product_id = '')
{
    if ($user_id != '' &&  $product_id != '') {
        $cart_details_sql = "select cart_details.*,user_cart.id as cart_id from cart_details,user_cart where cart_details.cart_id = user_cart.id and user_cart.user_id =  '$user_id' and cart_details.product_id = '$product_id'";
        $cart_details_res = mysqli_query($con, $cart_details_sql);
        $row = mysqli_fetch_assoc($cart_details_res);
        return $row;
    }
}

function count_data($con, $table_name = '')
{
    if ($table_name != '') {
        $sqlCount = "SELECT COUNT(*) AS count FROM $table_name where status='1'";
        $resCount = mysqli_query($con, $sqlCount);
        $rowCount = mysqli_fetch_assoc($resCount);
        return $rowCount['count'];
    }
}

function count_total_orders($con)
{
    $sqlCount = "SELECT COUNT(*) AS count FROM orders";
    $resCount = mysqli_query($con, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resCount);
    return $rowCount['count'];
}

function count_canceled_orders($con)
{
    $sqlCount = "SELECT COUNT(*) AS count FROM orders where status='0'";
    $resCount = mysqli_query($con, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resCount);
    return $rowCount['count'];
}

function count_completed_orders($con, $is_completed = '')
{
    if ($is_completed != '') {
        $sqlCount = "SELECT COUNT(*) AS count FROM orders where status='1' and is_completed = '$is_completed'";
        $resCount = mysqli_query($con, $sqlCount);
        $rowCount = mysqli_fetch_assoc($resCount);
        return $rowCount['count'];
    }
}


function get_total_sale($con, $table_name = '')
{
    if ($table_name != '') {
        $sqlCount = "SELECT SUM(total_bill) AS total FROM $table_name where is_completed = '1'";
        $resCount = mysqli_query($con, $sqlCount);
        $rowCount = mysqli_fetch_assoc($resCount);
        return $rowCount['total'];
    }
}

function get_user_from_session($con)
{
    if (isset($_SESSION['USER_EMAIL']) && $_SESSION['USER_EMAIL'] != '') {
        $email = $_SESSION['USER_EMAIL'];
        $sql = "SELECT * from users where status = '1' AND email='$email'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
}

function is_user_login()
{
    if (isset($_SESSION['USER_EMAIL']) && $_SESSION['USER_EMAIL'] != '') {
        return true;
    } else {
        return false;
    }
}


function is_admin_login()
{
    if (isset($_SESSION['ADMIN_EMAIL']) && $_SESSION['ADMIN_EMAIL'] != '') {
        return true;
    } else {
        return false;
    }
}

function getProductById($con, $product_id)
{
    if ($product_id != '' && isset($product_id)) {
        $get_product_sql = "SELECT * from product where id='$product_id'";
        $res = mysqli_query($con, $get_product_sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
}

function get_cart_by_user_id($con , $user_id = ''){
    if($user_id != ''){
        $get_cart_sql = "SELECT * from user_cart where user_id='$user_id'";
        $res = mysqli_query($con, $get_cart_sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
}