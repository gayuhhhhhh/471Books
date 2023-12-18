<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {
   $productId = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $query = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name'");
   $cart = mysqli_fetch_assoc($query);
   if (mysqli_num_rows($query) > 0) {
      $first_quantity = $cart['quantity'];
      mysqli_query($conn, "UPDATE products SET stock = stock - '$product_quantity' WHERE id = $productId");
      mysqli_query($conn, "UPDATE cart SET quantity = '$first_quantity' + '$product_quantity' WHERE name = '$product_name'");
      $message[] = 'Produk ditambahkan dikeranjang!';
   } else {
      mysqli_query($conn, "UPDATE products SET stock = stock - '$product_quantity' WHERE id = $productId");
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Produk ditambahkan dikeranjang!';
   }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>our product</h3>
      <p> <a href="home.php">Home</a> / Shop </p>
   </div>

   <section class="products">

      <h1 class="title">produk kami</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <a href="detail.php?id=<?php echo $fetch_products['id']; ?>"><img class="image"
                        src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></a>
                  <div class="name">
                     <?php echo $fetch_products['name']; ?>
                  </div>
                  <div class="price">Rp.
                     <?php echo $fetch_products['price']; ?>
                  </div>
                  <div class="stock" style="font-size: 15px; color: grey;">Stock:
                     <?php echo $fetch_products['stock']; ?>
                  </div>
                  <input type="hidden" name="product_id" value="<?= $fetch_products["id"] ?>">
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <?php if ($fetch_products['stock'] < 1) { ?>
                     <a class="btn">Stok Habis</a>
                  <?php } else { ?>
                     <input type="submit" value="+ Keranjang" name="add_to_cart" class="btn">
                  <?php } ?>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">Belum ada produk yang ditambahkan!</p>';
         }
         ?>
      </div>

   </section>








   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>