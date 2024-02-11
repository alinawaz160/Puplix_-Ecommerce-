<?php
require("user_top.php");
require("../admin/connection.inc.php");
$user_id = get_user_from_session($con)['id'];

$sql = "select orders.* from orders where orders.user_id = '$user_id' order by orders.created_at desc";
$res = mysqli_query($con, $sql);

$order_id = '';
if (isset($_POST['submit'])) {
    $order_id = get_safe_value($con, $_POST['orderId']);
}
?>
<section class="table__body">
    <h1 style="font-size:24px">Orders</h1>
    <table style="font-size:16px">
        <thead>
            <tr>
                <th> Serial <span class="icon-arrow">&UpArrow;</span></th>
                <th> Products <span class="icon-arrow">&UpArrow;</span></th>
                <th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
                <th> Quantity <span class="icon-arrow">&UpArrow;</span></th>
                <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                <th> Status <span class="icon-arrow">&UpArrow;</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td>
                        <?php echo $i++ ?>
                    </td>
                    <td>
                        <i onclick="showModal(<?php echo $row['id'] ?>)" id="order" class='fas fa-eye'
                            style='cursor:pointer;color:green;font-size:20px'></i>
                    </td>
                    <td>
                        <?php echo $row['created_at'] ?>
                    </td>
                    <td>
                        <?php echo $row['total_qty'] ?>
                    </td>
                    <td>
                        <?php echo $row['total_bill'] ?>
                    </td>
                    <td>
                        <?php
                        if ($row['status'] == 0) {
                            echo "<span class='status canceled'>Cancelled</span>";
                        } else if ($row['is_completed'] == 1) {
                            echo "<span class='status completed'>Completed</span>";
                        } else {
                            echo "<span class='status pending'>Pending</span>";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<div id="modal-content"></div>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function closeModal() {
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('modal').style.display = 'none';
    }
    function showModal(order_id) {
        jQuery.ajax({
            url: 'pop_up.php',
            type: 'post',
            data: "order_id=" + order_id,
            success: function (response) {
                jQuery('#modal-content').html(response);
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('modal').style.display = 'block';
            }
        })
    }
</script>
</body>

</html>