<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {

    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <style>
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e6e6e6;
        }

        thead tr:first-child {
            background-color: #006a4e;
            color: #fff;
        }

        .search-box {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .search-box input {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .search-box button {
            padding: 8px 12px;
            border: none;
            background-color: #006a4e;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-box button:hover {
            background-color: #0056b3;
        }

        /* CSS untuk tombol "View" */
        .btn-view {
            display: inline-block;
            padding: 4px 12px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-view i {
            margin-right: 5px;
        }

        .btn-view:hover {
            background-color: #0056b3;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="orders">

        <h1 class="title">placed orders</h1>

        <div class="container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search">
                <button type="button" id="searchButton">Search</button>
            </div>

            <h2 class="title">Payment Status: Pending</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Placed On</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Total Products</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                        if (mysqli_num_rows($select_orders) > 0) {
                            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                        ?>
                                <tr>
                                    <td><?php echo $fetch_orders['user_id']; ?></td>
                                    <td><?php echo $fetch_orders['placed_on']; ?></td>
                                    <td><?php echo $fetch_orders['name']; ?></td>
                                    <td><?php echo $fetch_orders['number']; ?></td>
                                    <td><?php echo $fetch_orders['email']; ?></td>
                                    <td><?php echo $fetch_orders['address']; ?></td>
                                    <td><?php echo $fetch_orders['total_products']; ?></td>
                                    <td>Rp. <?php echo $fetch_orders['total_price']; ?>/-</td>
                                    <td><?php echo $fetch_orders['method']; ?></td>
                                    <td><?php echo $fetch_orders['payment_status']; ?></td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <form action="admin_orders_detail.php" method="post" class="mb-2">
                                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                                <button type="submit" name="view" class="btn-view">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </form>
                                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="btn-view">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="11" class="text-center">No pending orders!</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container">
            <h2 class="title">Payment Status: Completed</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Placed On</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Total Products</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                        if (mysqli_num_rows($select_orders) > 0) {
                            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                        ?>
                                <tr>
                                    <td><?php echo $fetch_orders['user_id']; ?></td>
                                    <td><?php echo $fetch_orders['placed_on']; ?></td>
                                    <td><?php echo $fetch_orders['name']; ?></td>
                                    <td><?php echo $fetch_orders['number']; ?></td>
                                    <td><?php echo $fetch_orders['email']; ?></td>
                                    <td><?php echo $fetch_orders['address']; ?></td>
                                    <td><?php echo $fetch_orders['total_products']; ?></td>
                                    <td>Rp. <?php echo $fetch_orders['total_price']; ?>/-</td>
                                    <td><?php echo $fetch_orders['method']; ?></td>
                                    <td><?php echo $fetch_orders['payment_status']; ?></td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <form action="admin_orders_detail.php" method="post" class="mb-2">
                                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                                <button type="submit" name="view" class="btn-view">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </form>
                                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="btn-view">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="11" class="text-center">No completed orders!</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <script>
        document.getElementById('searchButton').addEventListener('click', function () {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.querySelectorAll('tbody tr');

            for (var i = 0; i < rows.length; i++) {
                var name = rows[i].querySelectorAll('td')[2].innerText.toLowerCase();
                if (name.indexOf(input) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>

</body>

</html>
