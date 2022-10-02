<?php
    $koneksi = mysqli_connect(
        "localhost",
        "root",
        "",
        "pinjol"
    );

    if (!$koneksi){
        die("Koneksi ke Database Gagal");
    } 
?>