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
      mysqli_query($conn, "UPDATE cart SET quantity = '$first_quantity' + '$product_quantity'   WHERE name = '$product_name'");
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>tangan anda memilih buku ke rumah anda.</h3>
         <p>Pilih buku sesuai keinginan anda, dan belanja sekarang.</p>
         <a href="shop.php" class="white-btn">Belanja Sekarang</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title">Produk Kami</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <a href="detail.php?id=<?php echo $fetch_products['id']; ?>"><img class="image"
                        src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></a>
                  <div class="name" style="font-weight: bold;">
                     <?php echo $fetch_products['name']; ?>
                  </div>
                  <div class="price">Rp.
                     <?php echo $fetch_products['price']; ?>
                  </div>
                  <div class="stock" style="font-size: 15px; color: grey;">Stock:
                     <?php echo $fetch_products['stock']; ?>
                  </div>
                  <input type="hidden" name="product_id" value="<?= $fetch_products["id"] ?>">
                  <input type="number" min="1" max="<?= $fetch_products['stock'] ?>" name="product_quantity" value="1"
                     class="qty">
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
            echo '<p class="empty">Belum ada produk!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">load more</a>
      </div>

   </section>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/about-img.jpg" alt="">
         </div>

         <div class="content">
            <h3>about us</h3>
            <p>Aplikasi ini memberikan akses langsung ke koleksi buku yang luas dan beragam. Dengan antarmuka yang ramah
               pengguna, pengguna dapat dengan mudah menjelajahi berbagai kategori buku, mulai dari fiksi hingga
               non-fiksi, sejarah, sastra, dan banyak lagi.</p>
            <a href="about.php" class="btn">read more</a>
         </div>

      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <h3>Ada pertanyaan ?</h3>
         <p>Contact kami jika anda memiliki masalah / kendala dan pertanyaan pada aplikasi kami!</p>
         <a href="contact.php" class="white-btn">contact us</a>
      </div>

   </section>





   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>