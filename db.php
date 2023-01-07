<?php
    $hostname   = 'localhost';
    $username   = 'root';
    $password   = '';
    $dbname     = 'db_thenblank'; //data base yang tadi udah dibuat

    $conn       = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal Terhubung ke database');

?>