<?php
include("../connection/config.php");
    if(isset($_POST['submit'])){
        $nama_produk = $_POST['nama_produk'];
        $stok_masuk = $_POST['stok_masuk'];
        $stok_keluar = $_POST['stok_keluar'];
        $tanggal = $_POST['tanggal'];

        //cek harga produk
        $query1 = "SELECT * FROM produk WHERE nama_produk = '$nama_produk'";
        $result1 = $dbConnection->query($query1);
        $data1 = mysqli_fetch_array($result1);
        $harga_produk = $data1['harga'];

        //stok_masuk
        $total_harga_stok_masuk = $stok_masuk * $harga_produk;
        //stok keluar
        $total_harga_stok_keluar = $stok_keluar * $harga_produk;
        //sisa
        $query2 = "SELECT stok FROM produk WHERE nama_produk = '$nama_produk'";
        $result2 = $dbConnection->query($query2);
        $data2 = mysqli_fetch_array($result2);
        $sisa_stok = $data2['stok'] + ($stok_masuk - $stok_keluar);
        $harga_sisa_stok = $sisa_stok * $harga_produk;

        //insert into stok_produk table
        $query3 = "INSERT INTO stok_produk (tanggal, produk_id, jumlah_masuk, total_harga_masuk, jumlah_keluar, total_harga_keluar, sisa_stok, harga_sisa_stok) VALUES ('$tanggal', (SELECT id FROM produk WHERE nama_produk ='$nama_produk'), '$stok_masuk', '$total_harga_stok_masuk', '$stok_keluar', '$total_harga_stok_keluar', '$sisa_stok', '$harga_sisa_stok')";
        $result3 = $dbConnection->query($query3);
        if($result3)
        {
            $query4 = "UPDATE produk SET stok ='$sisa_stok' WHERE nama_produk = '$nama_produk'";
            $result4 = $dbConnection->query($query4);
            if($result4){
                header('Location: ../penghitungan_stok/form-penghitungan-stok.php');
            }
        }else
        {
            die("Error in Insert Data stok_produk");
        }
        //update sisa_stok in produk table
        

    }
?>