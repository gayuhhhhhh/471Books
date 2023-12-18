<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_GET["id"])) {
   $order_id = $_GET["id"];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = 'Selesai' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'Terimakasih sudah berbelanja di toko kami!';
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

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>your orders</h3>
      <p> <a href="home.php">home</a> / orders </p>
   </div>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' ORDER BY id DESC ") or die('query failed');
         if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
               ?>
               <div class="box">
                  <p> Dipesan pada : <span>
                        <?php echo $fetch_orders['placed_on']; ?>
                     </span> </p>
                  <p> Nama : <span>
                        <?php echo $fetch_orders['name']; ?>
                     </span> </p>
                  <p> No Telepon : <span>
                        <?php echo $fetch_orders['number']; ?>
                     </span> </p>
                  <p> Alamat : <span>
                        <?php echo $fetch_orders['city'] . ', ' . $fetch_orders['address'] . ', ' . $fetch_orders['zip_code']; ?>
                     </span> </p>
                  <p> Pesanan anda : <span>
                        <?php echo $fetch_orders['total_products']; ?>
                     </span> </p>
                  <p> Total harga : <span>Rp.
                        <?php echo $fetch_orders['total_price']; ?>
                     </span> </p>
                  <p> Status pemesanan : <span style="color:<?php
                  if ($fetch_orders['payment_status'] == 'Tertunda') {
                     echo 'red';
                  } else {
                     echo 'green';
                  } ?>;">
                        <?php echo $fetch_orders['payment_status']; ?>
                     </span> </p>
                  <?php if ($fetch_orders['payment_status'] == 'Selesai') { ?>
                     <p> Klik selesai jika pesanan sudah sampai -> <a style="color: green;">Selesai</a>
                  <?php } else { ?>
                     <p> Klik selesai jika pesanan sudah sampai -> <a href="orders.php?id=<?= $fetch_orders["id"] ?>"
                           value="selesai">Selesai</a>
                     <?php } ?>
                  </p>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Belum ada pesanan!</p>';
         }
         ?>
      </div>

   </section>








   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>