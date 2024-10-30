<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT nama_produk, harga, nama_unit, img_url FROM produk INNER JOIN unit ON unit.id = produk.unit_id WHERE produk.id = '$id'";
        $result = $dbConnection->query($query);
        $data = mysqli_fetch_array($result);
        
        $nama_produkValue = $data['nama_produk'];
        $harga_produkValue = $data['harga'];
        $unit_produkValue = $data['nama_unit'];
        $img_url = $data['img_url'];

    }
?>