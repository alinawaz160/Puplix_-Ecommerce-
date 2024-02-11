<?php
require("authenticate.inc.php");
$categories = '';
$imageRequired = 'required';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $imageRequired = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from categories where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
        $image = $row['image'];
    } else {
        header("location:categories.php");
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);
    $res = mysqli_query($con, "select * from categories where categories='$categories'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Category already exists!!";
            }

        } else {
            $msg = "Category already exists!!";
        }
    }

    if ($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpeg') {
        $msg = "Only jpg, png , jpeg supported.";
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = get_safe_value($con, $_GET['id']);
            if ($_FILES['image']['name'] != '') {
                $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
                $update_query_sql = "update categories set categories='$categories',image='$image' where id='$id'";
            } else {
                $update_query_sql = "update categories set categories='$categories' where id='$id'";
            }
            $res = mysqli_query($con, $update_query_sql);
            if (!$res) {
                die("Query failed: " . mysqli_error($con));
            }
        } else {
            $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
            $res = mysqli_query($con, "INSERT INTO categories(categories, status, image) VALUES ('$categories', '1', '$image')");
            if (!$res) {
                die("Query failed: " . mysqli_error($con));
            }
        }
        header('location:categories.php');
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>AdminHub</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <ul class="side-menu top">
            <li>
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
            <li class="active">
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
            <a href="#" class="nav-link">Add Categories</a>
            <a href="#" class="profile">
                <?php
                echo "<img src='img/people.png' class='image' alt='' />";
                ?>
            </a>
        </nav>
        <!-- NAVBAR -->
        <div class="container" style="width:70%;height:70vh;">
            <div class="row mt-4">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Categories</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="categories" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="categories" name="categories"
                                        value="<?php echo $categories ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" <?php echo $imageRequired ?>>
                                </div>
                                <input type="submit" value="submit" name="submit" class="btn btn-primary" />
                                <div style="color:red;margin-top:10px">
                                    <?php echo $msg ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>