<?php 

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

$query = "SELECT * FROM users WHERE id='$user_id'";
$hasil = $conn->query($query);
$row = $hasil->fetch_assoc();

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

    <div class="profile">
        <a href="" class="fas fa-user"></a>
        <p><?php echo $_SESSION['user_name']; ?></p>
    </div>

    <div class="all-profile">


        <div class="menu-profile">
            <h3>Profile</h3>
        </div>

        <div class="isi-profile">
            <h2>Biodata Diri</h2>
            <div class="nama-profile">
                <h4>Nama: </h4>
                <p><?php echo $row['name']; ?></p>
            </div>
            <div class="email-profile">
                <h4>Email: </h4>
                <p><?php echo $row['email']; ?></p>
            </div>
            <div class="nohp-profile">
                <h4>Nomor Handphone: </h4>
                <p><?php echo $row['nohp']; ?></p>
            </div>
        </div>

        <div class="isi-profile">
            <h2>Alamat</h2>
            <div class="nama-profile">
                <h4>Alamat anda: </h4>
            </div>
            <div class="address-profile">
                <h4><?php echo $row['address']; ?></h4>
            </div>
        </div>

        <a href="logout.php"><button class="Logout">Logout</button></a>

    </div>

<!-- <?php include 'footer.php'; ?> -->

</body>

</html>