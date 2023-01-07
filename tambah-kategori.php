<?php
    session_start();
    include 'db.php';
    if ($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

?>
    <!-- yang atas jgn lupa masukin error reporting konsul phd1 -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>THEN BLANK</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">THEN BLANK</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="kategori.php">Kategori</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

<!--Content-->
<div class="section">
    <div class="container">
        <h3>Tambah Data Kategori</h3>
        <div class="box">
            <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                <input type="submit" name="submit" value="Tambah" class="btn">
            </form>

            <?php
                if(isset($_POST['submit'])){

                    $nama   = $_POST['nama'];

                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                        null,
                                        '".$nama."') ");
                    if($insert){
                        echo '<script>alert("Tambah Data Berhasil")</script>';
                        echo '<script>window.location="kategori.php"</script>';
                    } else
                        echo 'gagal'.mysqli_error($conn);
                }
            ?>
        </div>
    </div>
</div>

<!--Footer-->
<footer>
    <div class="container">
        <small> Copyright &copy; 2022 - THEN BLANK </small>
    </div>
</footer>

</body>
</html>

