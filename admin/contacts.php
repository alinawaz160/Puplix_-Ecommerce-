<?php
require("authenticate.inc.php");
$sql = "select * from contact order by id asc";
$res = mysqli_query($con, $sql);

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $delete_query = "DELETE FROM contact WHERE id='$id'";
        mysqli_query($con, $delete_query);
        header("Location:contacts.php");
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

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

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
            <li>
                <a href="categories.php">
                    <i class="bx bx-border-all"></i>
                    <span class="text">Categories</span>
                </a>
            </li>
            <li class="active">
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
            <a href="#" class="nav-link">Messages</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>

            </a>
            <a href="#" class="profile">
                <?php
                echo "<img src='img/people.png' class='image' alt='' />";
                ?>
            </a>
        </nav>
        <!-- NAVBAR -->




        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Sr. <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mobile <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Message <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Added On <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Action <span class="icon-arrow">&UpArrow;</span></th>
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
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo $row['email'] ?>
                            </td>
                            <td>
                                <?php echo $row['phone'] ?>
                            </td>
                            <td>
                                <?php echo $row['message'] ?>
                            </td>
                            <td>
                                <?php echo $row['created_at'] ?>
                            </td>
                            <td>
                                <?php echo "<a class='btn btn-danger btn-sm' href='?type=delete&id=" . $row['id'] . "'><i class='bx bx-trash'></i></a>"; ?>
                            </td>
                        </tr>
                        <tr>
                        <?php } ?>
                </tbody>
            </table>