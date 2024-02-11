<?php
require("authenticate.inc.php");
require("connection.inc.php");
// require("functions.inc.php");

$sql = "select orders.*, users.name as user from orders,users where orders.user_id = users.id and orders.status=1 order by orders.created_at desc";
$res = mysqli_query($con, $sql);
if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == "is_completed") {
		$operation = get_safe_value($con, $_GET['operation']);
		$id = get_safe_value($con, $_GET['id']);
		if ($operation == "active") {
			$is_completed = "1";
		} else {
			$is_completed = "0";
		}
		$update_query = "UPDATE orders set is_completed='$is_completed' WHERE id='$id'";
		mysqli_query($con, $update_query);
		header("Location:index.php");
		die();
	}
}

if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == "delete") {
		$id = get_safe_value($con, $_GET['id']);
		$delete_query = "UPDATE orders set status = '0' WHERE id='$id'";
		mysqli_query($con, $delete_query);
		header("Location: index.php");
		die();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!--Bootstrap 5 icons CDN-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
</head>
<style>
	.overlay2 {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
	}

	.modal2 {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 20px;
		background: #fff;
		border: 1px solid #ccc;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		z-index: 1000;
	}

	button {

		padding: 10px 20px;
		font-size: 16px;
		cursor: pointer;
		border: none;
		background-color: #3498db;
		color: #fff;
		border-radius: 5px;
	}
</style>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="index.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="customer.php">
					<i class='bx bxs-group'></i>
					<span class="text">Customer</span>
				</a>
			</li>
			<li>
				<a href="products.php">
					<i class='bx bxs-calendar-check'></i>
					<span class="text">Products</span>
				</a>
			</li>

			<li>
				<a href="categories.php">
					<i class="bx bx-border-all"></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
				<a href="contacts.php">
					<i class="bx bx-envelope"></i>
					<span class="text">Messages</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link"></a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			</a>
			<a href="#" class="profile">
				<?php
				echo "<img src='img/people.png' class='image' alt='' />";
				?>

			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>

			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-border-all'></i>
					<span class="text">
						<h5>
							<?php echo count_total_orders($con); ?>
						</h5>
						<p>Total Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-time'></i>
					<span class="text">
						<h5>
							<?php echo count_completed_orders($con, '0'); ?>
						</h5>
						<p>Pending Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h5>
							<?php echo count_completed_orders($con, '1'); ?>
						</h5>
						<p>Completed Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-x-circle'></i>
					<span class="text">
						<h3>
							<?php echo count_canceled_orders($con); ?>
						</h3>
						<p>Canceled Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<h3>
							<?php echo count_data($con, 'users'); ?>
						</h3>
						<p>Customers</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>
							<?php echo get_total_sale($con, 'orders'); ?>
						</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search'></i>
						<i class='bx bx-filter'></i>
					</div>
					<table>
						<thead>
							<tr>
								<th> Serial# <span class="icon-arrow">&UpArrow;</span></th>
								<th> User <span class="icon-arrow">&UpArrow;</span></th>
								<th> Products <span class="icon-arrow">&UpArrow;</span></th>
								<th> Total Quantity <span class="icon-arrow">&UpArrow;</span></th>
								<th> Total Bill <span class="icon-arrow">&UpArrow;</span></th>
								<th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
								<th> Status <span class="icon-arrow">&UpArrow;</span></th>
								<th> Actions <span class="icon-arrow">&UpArrow;</span></th>
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
										<?php echo $row['user'] ?>
									</td>
									<td>
										<i onclick="showModal(<?php echo $row['id'] ?>)" id="order" class='fas fa-eye'
											style='cursor:pointer;color:green;font-size:20px'></i>
									</td>
									<td>
										<?php echo $row['total_qty'] ?>
									</td>
									<td>
										<?php echo $row['total_bill'] ?>
									</td>
									<td>
										<?php echo $row['created_at'] ?>
									</td>
									<td>
										<?php
										if ($row['is_completed'] == 1) {
											echo "<a href='?type=is_completed&operation=de_active&id=" . $row['id'] . "'><span class='status completed'>Completed</span></a>";
										} else {
											echo "<a href='?type=is_completed&operation=active&id=" . $row['id'] . "'><span class='status pending'>Pending</span></a>";
										}
										?>
									</td>
									<td>
										<?php
										if ($row['is_completed'] == 0) {
											echo "<a href='?type=delete&operation&id=" . $row['id'] . "'><span class='status canceled'>Cancel</span></a>";
										}
										?>
									</td>
								</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</main>
		<div id="modal"></div>
		<!-- MAIN -->
	</section>
	<script src="script.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script>
		function closeModal() {
			document.getElementById('overlay2').style.display = 'none';
			document.getElementById('modal2').style.display = 'none';
		}
		function showModal(order_id) {
			jQuery.ajax({
				url: 'pop_up_admin.php',
				type: 'post',
				data: "order_id=" + order_id,
				success: function (response) {
					console.log(response);
					jQuery('#modal').html(response);
					document.getElementById('overlay2').style.display = 'block';
					document.getElementById('modal2').style.display = 'block';
				}
			})
		}
	</script>
</body>

</html>