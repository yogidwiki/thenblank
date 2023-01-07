<?php

    session_start();
    include 'db.php';
    if ($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }


?>

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
                <li><a href="data-produk.php">Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

<!--Content-->
<div class="section">
    <div class="container">
        <h3>Produk</h3>
        <div class="box">

            <p><a href="tambah-produk.php">Tambah Produk</a></p>
            <table border = "1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width=60px>No</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th width=180px>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                        if(mysqli_num_rows($produk) > 0)
                        {
                        while($row = mysqli_fetch_array($produk)){
                    ?>
                    <tr>
                        <td><?php echo $no++?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp.<?php echo number_format($row['product_price']) ?></td>
                        <td><?php echo $row['product_description'] ?></td>

                        <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="50px" ></a></td>

                        <td><?php ?><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                        <td>
                            <a href="edit-produk.php?id=<?php echo $row
                            ['product_id']?>"> Edit </a>       ||      <a href="proses-hapus.php?idp=<?php echo $row
                            ['product_id'] ?>" onclick = "return confirm('Yakin ingin menghapus produk?') ">Hapus</a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
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

