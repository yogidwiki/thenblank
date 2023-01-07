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

    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
        <h3>Tambah Data Produk</h3>
        <div class="box">
            <form action="" method="POST" enctype = "multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">--Pilih--</option>
                    <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    while($r = mysqli_fetch_array($kategori)){

                    ?>
                    <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                    <?php } ?>
                </select>

                <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                <input type="file"  name="gambar" class="input-control" required>
                <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea><br>

                <select class="input-control" name="status" >
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                </select>

                <input type="submit" name="submit" value="Tambah" class="btn">
            </form>

            <?php
                if(isset($_POST['submit'])){
                    
                    // print_r($_FILES['gambar']);
                    // menampung inputan dari form
                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];

                    // menampung data file yang diupload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'produk'.time().'.'.$type2;
                    // echo $type2;
                    // yang 0 = nama file, yang 1 = format file

                    //menampung data format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg','png', 'gif', 'mp4');

                      //validasi format file
                    if(!in_array($type2, $tipe_diizinkan)){
                        // jika format file tidak ada di dalam tipe diizinkan
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                
                    }else{
                        //jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                        // proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './produk/'.$newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                    null,
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$harga."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null
                                        )");

                        if($insert){
                            echo '<script> alert("Tambah data berhasil")</script>';
                            echo '<script>window.location="produk.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }    
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
        <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>

</body>
</html>

