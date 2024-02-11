<?php
require("../admin/connection.inc.php");
global $con, $user_id;
require("user_top.php");
$get_cart_details = get_user_cart_details($con, $user_id);
$user_id = get_user_from_session($con)['id'];
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == "update") {
        $operation = get_safe_value($con, $_GET['operation']);
        $qty = get_safe_value($con, $_GET['qty']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == "add") {
            $qty = $qty + 1;
        } else {
            $qty = $qty - 1;
        }
        $update_query = "UPDATE cart_details set qty='$qty' WHERE id='$id'";
        mysqli_query($con, $update_query);
        header("Location: cart.php");
    }
}
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $delete_query = "DELETE FROM cart_details WHERE id='$id'";
        mysqli_query($con, $delete_query);
        header("Location: cart.php");
    }
}

?>
<section class="table__body">
    <div style="display:flex;flex-direction:row;justify-content:space-between;">
        <h1 style="font-size:24px">Cart</h1>
        <button onclick="place_order()">Place Order</button>
    </div>
    <table style="font-size:16px">
        <thead>
            <tr>
                <th> Serial <span class="icon-arrow">&UpArrow;</span></th>
                <th> Product <span class="icon-arrow">&UpArrow;</span></th>
                <th> Price <span class="icon-arrow">&UpArrow;</span></th>
                <th> Qty <span class="icon-arrow">&UpArrow;</span></th>
                <th> Action <span class="icon-arrow">&UpArrow;</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $getProducts = get_user_cart_details($con, $user_id);
            foreach ($getProducts as $list) {
                ?>
                <tr>
                    <td>
                        <?php echo $i++ ?>
                    </td>
                    <td>
                        <?php echo $list['product_name'] ?>
                    </td>
                    <td>
                        <?php echo $list['price'] ?>
                    </td>
                    <td>
                        <?php
                        echo "<a style='color:green' href='?type=update&operation=add&qty=" . $list['qty'] . "&id=" . $list['id'] . "'><span class='status completed'>+</span></i></a>&nbsp";
                        echo $list['qty'] . '&nbsp';
                        echo "<a style='color:green' href='?type=update&operation=remove&qty=" . $list['qty'] . "&id=" . $list['id'] . "'><span class='status pending'>--</span></i></a>&nbsp";
                        ?>
                    </td>
                    <td>
                        <?php
                        echo "<a style='color:green' href='?type=delete&id=" . $list['id'] . "'><span class='status canceled'>Remove</span></i></a>";
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/script.js"></script>
<script>
    function place_order() {
        jQuery.ajax({
            url: 'place_order.php',
            type: 'post',
            success: function (result) {
                alert(result);
                window.location.href = 'cart.php';
            }
        })
    }

</script>
</body>

</html>