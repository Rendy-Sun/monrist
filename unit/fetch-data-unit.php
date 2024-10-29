<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT nama_unit FROM unit WHERE id = '$id'";
        $result = $dbConnection->query($query);
        $data = mysqli_fetch_array($result);
        
        echo $nama_unit = $data['nama_unit'];
    }
?>