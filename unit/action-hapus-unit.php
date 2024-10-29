<?php
    include("../connection/config.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM unit WHERE id=$id";
        $result = $dbConnection->query($query);
        if($result){
            header('Location: ../unit/form-unit.php');
        }
        else{
            die('Error Menghapus!');
        }
    }else{
        die("Akses dilarang");
    }
?>