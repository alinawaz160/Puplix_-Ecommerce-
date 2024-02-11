<?php
require("admin/connection.inc.php");
require("top.php");
?>
<section>
  <div class="row">
    <?php
      $getProducts = get_products($con ,'latest','', '');
      foreach($getProducts as $list) {
      ?>
      <div class="col-md-3 col-sm-5 col-xs-12">
        <div class="card-ser">
          <div class="cover" style="background: url('media/product/<?php echo $list['image']; ?>') no-repeat center;">
            <span class="price">$<?php echo $list['price'] ?></span>
            <h1><?php echo $list['name'] ?></h1>
            <div class="card-ser-back">
              <a href="#" onclick="add_to_cart(<?php echo $list['id'] ?>)">Add to cart</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</section>
<section></section>
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
<?php
require("footer.php")
  ?>