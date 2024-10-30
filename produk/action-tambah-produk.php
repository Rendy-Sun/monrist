<?php
    include("../connection/config.php");
    if(isset($_POST["submit"])){
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $unit_produk = $_POST['unit_produk'];
        $img_url = $_POST['img_url'];
        $queryCheck = "SELECT * FROM produk WHERE nama_produk = '$nama_produk'";
        $resultCheck = $dbConnection->query($queryCheck);
        if(mysqli_num_rows($resultCheck)>0)
        {
            echo '<script>alert("Produk Sudah Pernah Di Tambahkan!"); location.href="../produk/form-produk.php?pencarian=&halaman=1"</script>';
        }
        else{
            $sql = "INSERT INTO produk (nama_produk, harga, unit_id, stok, img_url) VALUES ('$nama_produk', '$harga_produk', (SELECT id FROM unit WHERE nama_unit = '$unit_produk'), '0', '$img_url')";
            $result = $dbConnection->query($sql);    
        if ($result) {
            header('Location: ../produk/form-produk.php?pencarian=&halaman=1');
        }
        else {
            die('akses dilarang!');
        }
        }
    }
       
?>