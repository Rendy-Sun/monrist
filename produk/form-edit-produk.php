<?php
    include("../connection/config.php");
?>
<html>
    <head>
        <title>
            Monrist
        </title>
        <link rel="stylesheet" type="text/css" href="../produk/style-form-edit-produk.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <?php
            include("../navigation/navigation.php");
        ?>
    </head>
    <body>
        <form action ="../produk/action-edit-produk.php" method="POST">
            <div class="container">
                <header>
                    <h1>Edit Produk</h1>
                </header>
                <input hidden type="text" name="id_produk" required value="<?php include("../produk/fetch-data-produk.php"); echo $id; ?>">
                <div class="row">
                    <div class="col-25">
                        <label>Nama Produk </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="nama_produk" required placeholder="Produk 1" value="<?php include("../produk/fetch-data-produk.php"); echo $nama_produkValue; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Harga Produk </label>
                    </div>
                    <div class="col-75">
                        <input type="number" name="harga_produk" required placeholder="0" value="<?php include("../produk/fetch-data-produk.php"); echo $harga_produkValue; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Unit Produk </label>
                    </div>
                    <div class="col-75">
                        <select name="unit_produk">
                            <?php 
                                include("../produk/fetch-data-produk.php");
                                $query2 = "SELECT nama_unit FROM unit";
                                $result2 = $dbConnection->query($query2);
                                while($row_data = mysqli_fetch_array($result2)){
                                    echo '<option value="'.$row_data['nama_unit'].'">'.$row_data['nama_unit'].'</option>';
                                    if($unit_produkValue == $row_data['nama_unit'])
                                    {
                                        echo '<option hidden value="'.$row_data['nama_unit'].'" selected >'.$row_data['nama_unit'].'</option>';
                                    }
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="submit" id="tambahSubmit" class="submitTambah" value="Edit"/>
                </div>
            </div>                    
        </form>
    </body>
</html>