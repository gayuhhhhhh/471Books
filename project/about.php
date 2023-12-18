<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>mengapa anda harus memilih kami?</h3>
         <p>Aplikasi ini memberikan akses langsung ke koleksi buku yang luas dan beragam. Dengan antarmuka yang ramah pengguna, pengguna dapat dengan mudah menjelajahi berbagai kategori buku, mulai dari fiksi hingga non-fiksi, sejarah, sastra, dan banyak lagi.</p>
         <p>Dengan keandalan, kemudahan penggunaan, dan akses yang luas ke pengetahuan melalui buku, aplikasi penjualan buku 471 Books menjadi sahabat setia para pecinta literasi dalam menjelajahi dunia tak terbatas melalui halaman-halaman buku.</p>
         <a href="contact.php" class="btn">Hubungi kami</a>
      </div>

   </div>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>