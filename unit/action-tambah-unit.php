<?php
    include("../connection/config.php");
    if(isset($_POST["submit"])){
        $nama_unit = $_POST['nama_unit'];
        $queryCheck = "SELECT * FROM unit WHERE nama_unit = '$nama_unit'";
        $resultCheck = $dbConnection->query($queryCheck);
        if(mysqli_num_rows($resultCheck)>0)
        {
            echo '<script>alert("Unit Sudah Pernah Di Tambahkan!"); location.href="../unit/form-unit.php"</script>';
        }
        else{
            $sql = "INSERT INTO unit (nama_unit) VALUES ('$nama_unit')";
            $result = $dbConnection->query($sql);    
        if ($result) {
            header('Location: ../unit/form-unit.php?');
        }
        else {
            die('akses dilarang!');
        }
        }
    }
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        if($id == null){
            echo '<script>alert("Silahkan Pilih Data Yang Ingin di Edit !"); location.href="../unit/form-unit.php"</script>';
        }else if($id !=null){
            $nama_unit = $_POST['nama_unit'];
            $query = "UPDATE unit SET nama_unit = '$nama_unit' WHERE id='$id'";
            $result = $dbConnection->query($query);
            if ($result) {
                header('Location: ../unit/form-unit.php?');
            }
            else {
                die('akses dilarang!');
            }
        }
    }
       
?>