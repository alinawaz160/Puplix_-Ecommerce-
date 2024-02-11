<?php
require("authenticate.inc.php");
$name = '';
$mrp = '';
$price = '';
$qty = '';
$description = '';
$short_desc = '';
$categories_id = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$imageRequired = 'required';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $imageRequired = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from product where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $description = $row['description'];
        $short_desc = $row['short_desc'];
        $categories_id = $row['categories_id'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
        $image = $row['image'];
    } else {
        header("location:products.php");
        die();
    }
}

if (isset($_POST['submit'])) {
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $qty = get_safe_value($con, $_POST['qty']);
    $description = get_safe_value($con, $_POST['description']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
    $res = mysqli_query($con, "select * from product where name='$name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Product already exists!!";
            }

        } else {
            $msg = "Product already exists!!";
        }
    }

    if ($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpeg') {
        $msg = "Only jpg, png , jpeg supported.";
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = get_safe_value($con, $_GET['id']);

            if ($_FILES['image']['name'] != '') {
                $image = rand(11111111, 99999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
                $update_query_sql = "UPDATE product SET 
                name='$name', 
                mrp='$mrp',
                price='$price',
                qty='$qty',
                description='$description',
                short_desc='$short_desc',  -- Corrected the field name here
                categories_id='$categories_id',
                meta_title='$meta_title',
                meta_desc='$meta_desc',
                meta_keyword='$meta_keyword',
                image='$image'
                WHERE id='$id'";
            } else {
                $update_query_sql = "UPDATE product SET 
                name='$name', 
                mrp='$mrp',
                price='$price',
                qty='$qty',
                description='$description',
                short_desc='$short_desc',  -- Corrected the field name here
                categories_id='$categories_id',
                meta_title='$meta_title',
                meta_desc='$meta_desc',
                meta_keyword='$meta_keyword' 
                WHERE id='$id'";
            }

            $res = mysqli_query($con, $update_query_sql);

            if (!$res) {
                die("Query failed: " . mysqli_error($con));
            }
        } else {
            $image = rand(11111111, 99999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
            $res = mysqli_query($con, "INSERT INTO product(name,mrp,price,qty,description,short_desc,categories_id,meta_title,meta_desc,meta_keyword,
            status, image) VALUES 
           ('$name','$mrp','$price','$qty','$description','$short_desc','$categories_id','$meta_title','$meta_desc','$meta_keyword',
            '1', '$image')");

            if (!$res) {
                die("Query failed: " . mysqli_error($con));
            }
        }
        header('location:products.php');
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
            <a href="#" class="nav-link">Add Product</a>
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
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $name ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categories_id" class="form-label">Category</label>
                                    <select class="form-select" id="categories_id" name="categories_id" required
                                        value="<?php echo $categories_id ?>">
                                        <option>Select Category</option>
                                        <?php
                                        $get_categories_query = "select id,categories from categories order by categories desc";
                                        $res = mysqli_query($con, $get_categories_query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            if ($row['id'] == $categories_id) {
                                                echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                            }
                                            echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="<?php echo $price ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="qty" name="qty"
                                        value="<?php echo $qty ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mrp" class="form-label">MRP</label>
                                    <input type="number" class="form-control" id="mrp" name="mrp"
                                        value="<?php echo $mrp ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="short_desc" class="form-label">Short Description</label>
                                    <input type="text" class="form-control" id="short_desc" name="short_desc"
                                        value="<?php echo $short_desc ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description"
                                        value="<?php echo $description ?>"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_desc" class="form-label">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_desc" name="meta_desc"
                                        value="<?php echo $meta_desc ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        value="<?php echo $meta_title ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                                        value="<?php echo $meta_keyword ?>">
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