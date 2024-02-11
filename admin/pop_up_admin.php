<?php
require("connection.inc.php");
$order_id = $_POST['order_id'];
if ($order_id != '') {
    $get_order_details_query = "SELECT * from order_details where order_id='$order_id'";
    $get_order_details_res = mysqli_query($con, $get_order_details_query);
    $get_order_details_data = array();
    while ($rows = mysqli_fetch_assoc($get_order_details_res)) {
        $get_order_details_data[] = $rows;
    }
}
?>
<div class="overlay2" id="overlay2"></div>
<div class="modal2" id="modal2">
    <h2><i class="fas fa-shopping-cart"></i> Order Details</h2>
    <section class="table__body">
        <table style="font-size: 16px">
            <thead>
                <tr>
                    <th> Serial </th>
                    <th> Product Name </th>
                    <th> Quantity </th>
                    <th> Price </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($get_order_details_data as $list) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $i++ ?>
                        </td>
                        <td>
                            <?php echo $list['product_name'] ?>
                        </td>
                        <td>
                            <?php echo $list['qty'] ?>
                        </td>
                        <td>
                            <?php echo $list['price'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <button onclick="closeModal()">Close</button>
</div>