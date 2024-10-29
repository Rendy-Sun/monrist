<?php 
include("../connection/config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //Delete Data By Selected ID
    $query = "DELETE FROM stok_produk WHERE id='$id'";
    $result = $dbConnection->query($query);
    if($result){
        //header('Location: ../penghitungan_stok/form-penghitungan-stok.php');
        //Get all Stok masuk after delete data
        $query1 = "SELECT SUM(jumlah_masuk) AS jumlah_masuk, SUM(jumlah_keluar) AS jumlah_keluar FROM stok_produk";
        $result1 = $dbConnection->query($query1);
        $data1 = mysqli_fetch_array($result1);
        $jumlah_masuk = $data1['jumlah_masuk'];

        //Get all Stok keluar after Delete Data
        $jumlah_keluar = $data1['jumlah_keluar'];
        //get sisa stok
        $sisa_stok = $jumlah_masuk-$jumlah_keluar;
        //update sisa stok produk
        $query2 ="UPDATE produk SET stok ='$sisa_stok'";
        $result2 = $dbConnection->query($query2);
        if($result2){
            header('Location: ../penghitungan_stok/form-penghitungan-stok.php');
        }

    }
    else{
        die('Error Menghapus!');
    }
}else{
    die("Akses dilarang");
}
?>