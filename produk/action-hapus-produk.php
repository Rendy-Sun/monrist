<?php
    include("../connection/config.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM produk WHERE id=$id";
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