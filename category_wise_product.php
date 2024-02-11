<?php
$categories_id = '';
require("admin/connection.inc.php");
require("top.php");
if (isset($_GET['categories_id']) && $_GET['categories_id'] != '') {
	$categories_id = get_safe_value($con ,$_GET['categories_id']);
}
?>

<section class="section-products">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-md-8 col-lg-6">
				<div class="header">
					<h3>Featured Product</h3>
					<h2>Popular Products</h2>
				</div>
			</div>
		</div>
		<div class="row">
		<?php 
			$getProducts = get_products($con , '','',$categories_id);
			foreach($getProducts as $list){
			?>
			<div class="col-md-6 col-lg-4 col-xl-3">
				<div class="single-product" 
					style="background: url('media/product/<?php echo $list['image']; ?>') no-repeat center;
						   background-size: cover;transition: all 0.3s;">
					<div class="part-1">
						<ul>
							<li><a href="#"><i onclick="add_to_cart(<?php echo $list['id'] ?>)" class="fas fa-shopping-cart"></i></a></li>
							<li><a href="#"><i class="fas fa-heart"></i></a></li>
							<!-- <li><a href="#"><i class="fas fa-plus"></i></a></li> -->
							<li><a href="#"><i class="fas fa-expand"></i></a></li>
						</ul>
					</div>
					<div class="part-2">
						<h3 class="product-title"><?php echo $list['name']; ?></h3>
						<h4 class="product-price">$<?php echo $list['price']; ?></h4>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function add_to_cart(product_id){
    jQuery.ajax({
            url: 'add_to_cart.php',
            type: 'post',
            data: "product_id=" + product_id,
            success: function (response) {
               alert(response);
            }
        })
  }
</script>
<section>
	<?php
	require("footer.php");
	?>