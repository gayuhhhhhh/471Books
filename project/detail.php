<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$bookId = $_GET["id"];
$id_produk = $_GET['id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$query = "SELECT * FROM products WHERE id='$bookId'";
$hasil = $conn->query($query);
$row = $hasil->fetch_assoc();

if (isset($_GET['add_to_cart'])) {
    $product_name = $_GET['product_name'];
    $product_price = $_GET['product_price'];
    $product_image = $_GET['product_image'];
    $product_quantity = $_GET['product_quantity'];
    mysqli_query($conn, "UPDATE products SET stock = stock - 1 WHERE id = $id_produk");
    
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if (mysqli_num_rows($check_cart_numbers) > 0) {
       $message[] = 'Sudah ada dikeranjang!';
    } else {
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'Produk ditambahkan dikeranjang!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<?php include 'header.php'; ?>

<body>

    <div class="details">

        
        <img src="uploaded_img/<?php echo $row['image']; ?>" alt="">


        <div class="details-book">
            <h1 class="title-details">
                <?php echo $row['name']; ?>
            </h1>
            <h1 class="price">Rp. <?php echo $row['price']; ?></h1>
            <p>Detail</p>
            <h2>Penulis :</h2>
            <h3><?php echo $row['penulis']; ?>.</h3>
            <h4>Sinopsis : </h4>
            <h5><?php echo $row['sinopsis']; ?></h3>


        </div>

</body>

</html>