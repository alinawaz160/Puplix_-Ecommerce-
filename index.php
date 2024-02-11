<?php
require("admin/connection.inc.php");
require("top.php");
$sql = "select * from categories where status=1 order by categories asc";
$res = mysqli_query($con, $sql);
?>
<section class="home">
  <div class="content">
    <h1> <span>Find Out</span>
      <br>
      Pets <span id="span2">You</span> Love
    </h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, saepe.
      <br>Lorem ipsum dolor sit amet consectetur.
    </p>
    <a href="shop.html">
      <div class="btn"><button>Shop Now</button></div>
    </a>
  </div>
  <div class="img">
    <img src="./assets/images/petttttt.png" alt="">
  </div>
</section>
<div class="container-fluid py-5">
  <div class="container">
    <div class="row gx-5">
      <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
        <div class="position-relative h-100">
          <img class="position-absolute w-100 h-100 rounded" src="./assets/images/pup store.jpg"
            style="object-fit: cover;">
        </div>
      </div>
      <div class="col-lg-7">
        <div class="border-start border-5 border-primary ps-5 mb-5">
          <h1>About Us</h1>
          <h3 class="display-7">We Keep Your Pets Happy All Time</h3>
        </div>
        <h4 class="text-body mb-4">Diam dolor diam ipsum tempor sit. Clita erat ipsum et lorem stet no labore lorem sit
          clita duo justo magna dolore</h4>
        <div class="bg-light p-4">
          <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                <p class="mb-0">Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et,
                  tempor voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum
                  et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata
                  eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et
                  magna</p>
              </div>
              <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                <p class="mb-0">Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et,
                  tempor voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum
                  et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata
                  eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et
                  magna</p>
              </div>
            </div>

        </div>
        <a href="about.php">
          <div class="btn"><button>Learn More</button></div>
        </a>

      </div>
    </div>
  </div>
</div>

<div class="container-fluids">
  <div class="container">
    <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
      <h1>Services</h1>
      <h3 class="display-7">Our Excellent Pet Care Services</h3>
    </div>
    <div class="content-box">
      <div class="card-new" id="d">
        <h1 class="fas fa-paw fas-mid dispaly-1"></h1>
        <h2>Pet Boarding</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>
      </div>

      <div class="card-new">
        <h1 class="fas fa-paw fas-mid dispaly-1">
        </h1>
        <h2> Pet Grooming</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>
      </div>

      <div class="card-new">
        <h1 class="fa fa-paw fas-mid dispaly-1">

        </h1>
        <h2>Pet Feeding</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>
      </div>
      <div class="card-new">
        <h1 class="fas fa-paw fas-mid dispaly-1"></h1>
        <h2>Pet Exercise</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>
      </div>
      <div class="card-new">
        <h1 class="fas  fa-paw fas-mid dispaly-1"></h1>
        <h2>Pet Training</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>

      </div>
      <div class="card-new">
        <h1 class="fas fa-paw fas-mid dispaly-1"></h1>
        <h2>Pet Treatment</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!</p>
      </div>
    </div>

  </div>
</div>
<br>
<br>
<br>
<div class="container-fluids">
  <div class="container">
    <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
      <h1>Categories</h1>
      <h3 class="display-7">Lorem ipsum dolor sit</h3>
    </div>
    <div class="cat">
      <table id="table">
        <tr>
          <td colspan="2" style="text-align:right;">
          </td>
        </tr>
        <tr>
          <td colspan="4">
          </td>
        </tr>
        <tr>
          <?php
          $i = 0;
          while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <td>
              <div class="div1">
                <img src="media/product/<?php echo $row['image'] ?>" style="width: 190px;height: 190px;"
                  class="img-fluid" />
                <p>
                  <?php echo $row['description'] ?>
                </p>
                <?php
                echo "<a href='category_wise_product.php?categories_id=" . $row['id'] . "'><button class='btn btn1'>Category " . ++$i . "</button></a>";
                ?>

                <br /><br />
              </div>
            </td>
          <?php } ?>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <?php mysqli_data_seek($res, 0); ?>

          <!-- Second loop for category names -->
          <?php
          $i = 0;
          $styleArray = array("like", "comment", "share", "subs");
          while ($category = mysqli_fetch_assoc($res)) {
            ?>
            <td class="footer <?php echo $styleArray[$i++] ?>">
              <?php echo $category['categories'] ?>
            </td>
          <?php } ?>
        </tr>
      </table>
    </div>

    <!-- category_end -->

    <!-- products -->
    <br>
    <br>
    <br>

    <div class="container-fluids">
      <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
          <h1>Products</h1>
          <h3 class="display-7">Our mostly used Pets Products </h3>
        </div>

      </div>

    </div>
  </div>
  <div class="container" id="product-cards">
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/How-its-works (1).png" alt=" ">
          <div class="card-body">
            <h3 class="text-center">Dogs Food</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$100 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/images__3_-removebg-preview (1).png" alt="">
          <div class="card-body">
            <h3 class="text-center">Grooming tools</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$150 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/Proseries_Adult_Cat_Food_1024x10.png" alt="">
          <div class="card-body">
            <h3 class="text-center">Cats food</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$100 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/pp6..png" alt="">
          <div class="card-body">
            <h3 class="text-center">Fish accessories</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$300 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/images-removebg-preview (2).png" alt="">
          <div class="card-body">
            <h3 class="text-center">Birds food</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$50.60 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/pp5.png" alt="">
          <div class="card-body">
            <h3 class="text-center">Cats&Dogs belts</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$600 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/CC4242-silver-removebg-preview (1).png" alt="">
          <div class="card-body">
            <h3 class="text-center">Birds cages</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$500 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="card">
          <img src="./assets/images/pp7.png" alt="">
          <div class="card-body">
            <h3 class="text-center">Food bowls</h3>
            <p class="text-center">Lorem ipsum dolor sit amet.</p>
            <div class="star text-center">
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
              <i class="fas fa-star checked"></i>
            </div>
            <!-- <h2>$60 <span>
                <li class="fas fa-shopping-cart"></li>
              </span></h2> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require("footer.php");
  ?>