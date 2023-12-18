<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   // $user_type = $_POST['tipe_akun'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User sudah ada!';
   }else{
      if($pass != $cpass){
         $message[] = 'Masukkan password dengan benar!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, nohp, address, password) VALUES('$name', '$email', '$nohp', '$address', '$cpass')") or die('query failed');
         $message[] = 'Registrasi berhasil';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register</h3>
      <input type="text" name="name" placeholder="Masukkan nama anda" required class="box">
      <input type="email" name="email" placeholder="Masukkan email anda" required class="box">
      <input type="number" name="nohp" placeholder="Masukkan no handphone anda" required class="box">
      <input type="text" name="address" placeholder="Masukkan alamat anda" required class="box">
      <input type="password" name="password" placeholder="Masukkan password anda" required class="box">
      <input type="password" name="cpassword" placeholder="Masukkan kembali password anda" required class="box">
      <!-- <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select> -->
      <input type="submit" name="submit" value="Register" class="btn">
      <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
   </form>

</div>

</body>
</html>