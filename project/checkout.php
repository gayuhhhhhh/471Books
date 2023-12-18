<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$hasil = $conn->query($query);
$row = $hasil->fetch_assoc();

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['order_btn'])) {

   $city = $_POST["city"];
   $zip_code = $_POST["zip_code"];

   $name = mysqli_real_escape_string($conn, $row['name']);
   $number = $row['nohp'];
   $address = mysqli_real_escape_string($conn, $row['address']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $zip_code = mysqli_real_escape_string($conn, $_POST['zip_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode($cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
      $message[] = 'Keranjang kosong';
   } else {
      mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, address, total_products, total_price, city, zip_code, placed_on, payment_status, status_kurir) VALUES('$user_id', '$name', '$number', '$address', '$total_products', '$cart_total', '$city', '$zip_code', '$placed_on', 'Proses', 'Selesai')") or die('query failed');
      $message[] = 'Sukses dipesan!';
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      header ('Location: orders.php');
      exit();
   }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>checkout</h3>
      <p> <a href="home.php">Home</a> / Checkout </p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
            ?>
            <p>
               <?php echo $fetch_cart['name']; ?> <span>(
                  <?php echo 'Rp.' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)
               </span>
            </p>
            <?php
         }
      } else {
         echo '<p class="empty">Keranjang kamu kosong</p>';
      }
      ?>
      <div class="grand-total"> Grand total : <span>Rp.
            <?php echo $grand_total; ?>
         </span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post" id="orderForm" onsubmit="return checkExpDate();">
         <div class="payment">
            <h1>Ringkasan</h1>
            <div class="ringkasan">
               <input type="text" name="customer_name" placeholder="Nama" value="<?php echo $row['name'] ?>">
               <input type="text" name="customer_address" placeholder="Alamat" value="<?php echo $row['address'] ?>">
               <input type="text" name="customer_phone" placeholder="No handphone" value="<?php echo $row['nohp'] ?>">
               <div class="ringkasan-detail">
                  <input type="text" name="city" placeholder="Kota" value="<?php echo $row['city'] ?>">
                  <input type="number" name="zip_code" placeholder="Kode pos" value="<?php echo $row['zip_code'] ?>">
               </div>
            </div>
            <h1>Detail Kartu</h1>
            <div class="card-detail">
               <input type="text" name="card_name" placeholder="Nama di kartu">
               <input type="number" name="card_number" placeholder="Nomor kartu">
               <div class="card-detail-exp">
                  <input type="number" id="expMonth" placeholder="Bulan Exp" min="1" max="12" required>
                  <input type="number" id="expYear" placeholder="Tahun Exp" min="2023" required>
                  <input type="number" name="cvv" placeholder="CVV">
               </div>
               <button type="submit" style="width: 100%; background-color: blue;" name="order_btn"
                  class="btn">Pesan</button>
            </div>
         </div>
      </form>

      <script>
         function checkExpDate() {
            var expMonth = document.getElementById('expMonth').value;
            var expYear = document.getElementById('expYear').value;
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var currentMonth = currentDate.getMonth() + 1;

            if (expYear < currentYear || (expYear == currentYear && expMonth < currentMonth)) {
               alert('Kartu telah kedaluwarsa!');
               return false;
            } else {
               return true;
            }
         }
      </script>
   </section>





   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>