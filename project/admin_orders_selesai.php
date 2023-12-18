<?php

include 'config.php';

session_start();

$user_id = $_SESSION['admin_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$query = "SELECT * FROM orders WHERE payment_status = 'Selesai'";
$hasil = $conn->query($query);

// if(isset($_POST['update_order'])){

//    $order_update_id = $_POST['order_id'];
//    $update_payment = $_POST['update_payment'];
//    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
//    $message[] = 'Status pembayaran telah diubah!';

// }

// if(isset($_GET['delete'])){
//    $delete_id = $_GET['delete'];
//    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
//    header('location:admin_orders.php');
// }

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

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="orders">

        <h1 class="title">placed orders</h1>

        <div class="container-pesanan">

            <div class="coloumn">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Judul Buku</th>
                            <th>Dipesan Pada</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
            </div>
            <?php $numbernum = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
                <div class="data-pesanan">
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $numbernum ?>
                            </td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo $row['number'] ?>
                            </td>
                            <td>
                                <?php echo $row['city'] . ", " . $row['address'] . ", " . $row['zip_code'] ?>
                            </td>
                            <td>
                                <?php echo $row['total_products'] ?>
                            </td>
                            <td>
                                <?php echo $row['placed_on'] ?>
                            </td>
                            <td>Rp.
                                <?php echo $row['total_price'] ?>
                            </td>
                            <td>
                                <?php echo $row['payment_status'] ?>
                            </td>
                        </tr>
                    </tbody>
                </div>
                <?php $numbernum++; ?>
            <?php } ?>


            <div class="data-pesanan">

            </div>

        </div>



    </section>










    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>