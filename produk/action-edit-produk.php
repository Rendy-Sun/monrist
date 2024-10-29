<?php
    include("../connection/config.php");
    if(isset($_POST['submit'])){
        $id_produk = $_POST['id_produk'];
        
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $unit_produk = $_POST['unit_produk'];
        $query = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga_produk', unit_id = (SELECT id FROM unit WHERE nama_unit = '$unit_produk') WHERE id=$id_produk";
        $result = $dbConnection->query($query);
        if($result){
            header('Location: ../produk/form-produk.php?pencarian=&halaman=1');
        }
        else{
            die('Error Menghapus!');
        }
    }else{
        die("Akses dilarang");
    }
?>