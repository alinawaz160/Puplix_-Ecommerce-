<?php
require("user_top.php");
$name = '';
$email = '';
$password = '';
$imageRequired = 'required';
$msg = '';
$user_id = get_user_from_session($con)['id'];
if (isset($user_id) && $user_id != '') {
   $imageRequired = '';
   $res = mysqli_query($con, "select * from users where id='$user_id'");
   $check = mysqli_num_rows($res);
   if ($check > 0) {
      $row = mysqli_fetch_assoc($res);
      $name = $row['name'];
      $email = $row['email'];
      $img = $row['image'];
      if($img != ''){
         $imageRequired = '';
      }
   } else {
      header("location:index.php");
      die();
   }
}

if (isset($_POST['submit'])) {
   if (isset($user_id) && $user_id != '') {
      $name = get_safe_value($con, $_POST['name']);
      $password = get_safe_value($con, $_POST['password']);
      $confirm_password = get_safe_value($con, $_POST['confirm_password']);
      $email = get_safe_value($con, $_POST['email']);

      if ($password != $confirm_password) {
         $msg = 'Password does not match';
      } else {
         $msg = '';
      }
      if ($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpeg') {
         $msg = "Only jpg, png , jpeg supported.";
      }
      if ($msg == '') {
         if ($_FILES['image']['name'] != '') {
            $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/profile/' . $image);
            $update_query_sql = "update users set name='$name',email='$email',password='$password',image='$image' where id='$user_id'";
         } 
         else {
            $update_query_sql = "update users set name='$name',email='$email' where id='$user_id'";
         }
         $res = mysqli_query($con, $update_query_sql);
         $_SESSION['USER_EMAIL'] = $email;
         if (!$res) {
            die("Query failed: " . mysqli_error($con));
         }
         header('location:index.php');
         die();
      }
   }
   else{
      header('location:/puplix/register.php');
      die();
   }
}

?>
<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <div style="color:red;margin-top:5px;font-size:12px">
         <?php echo $msg ?>
      </div>
      <p>update name</p>
      <input type="text" value="<?php echo $name ?>" name="name" placeholder="Enter your name" maxlength="50"
         class="box">
      <p>update email</p>
      <input type="email" value="<?php echo $email ?>" name="email" placeholder="Enter your email" maxlength="50"
         class="box">
      <p>new password</p>
      <input type="password" name="password" placeholder="enter your password" maxlength="20" class="box">
      <p>confirm password</p>
      <input type="password" name="confirm_password" placeholder="confirm your new password" maxlength="20" class="box">
      <p>update pic</p>
      <input type="file" class="form-control" id="image" name="image" <?php echo $imageRequired ?>>
      <input type="submit" value="submit" name="submit" class="btn">

   </form>

</section>

















<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>

</html>