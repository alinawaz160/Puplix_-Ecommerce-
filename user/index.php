<?php
require("user_top.php");
require("user_authenticate.inc.php");
?>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
         <?php
         if ($image != '') {
            echo "<img src='../media/profile/" . $image . "' class='image' alt='' />";
         } else {
            echo "<img src='https://tse4.mm.bing.net/th?id=OIP.tvaMwK3QuFxhTYg4PSNNVAHaHa&pid=Api&P=0&h=220' class='image' alt='' />";
         } ?>
         <h3 class="name">
            <?php echo $name ?>
         </h3>
         <p class="role">
            <?php echo $email ?>
         </p>
      </div>

      <div class="box-container">

         <div class="box">
            <div class="flex">
               <i class="fas fa-bookmark"></i>
               <div>
                  <span>4</span>
                  <p>saved playlist</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view playlists</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <span>33</span>
                  <p>videos liked</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view liked</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <span>12</span>
                  <p>videos comments</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div>

      </div>
   </div>

</section>















<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>

</html>