<?php
include("../connection/config.php");
?>
<html>
    <head>
        <title>Monrist</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../unit/style-form-unit.css"/>
        <?php
            include("../navigation/navigation.php");
        ?>
    </head>

    <body>
    <div class="header">
        <header><h2>Daftar Unit</h2></header>
    </div>
    <form action="../unit/action-tambah-unit.php" method="POST">
    <div class="row">
        <div class="subcolumn-1">
            <label>Nama Unit</label>
        </div>
        <div class="subcolumn-2">
            <input type="text" name="nama_unit" placeholder="cm, m, pcs .. etc" value="<?php include("../unit/fetch-data-unit.php");?>" required>
        </div>
        <div class="subcolumn-3">
            <input type="submit" name="submit" class="tambahProduk" value="Tambah Unit"/>
        </div>
        <div class="subcolumn-4">
            <input type="text" hidden name="id"value=<?php include("../unit/fetch-id-unit.php");?>>
            <input type="submit" name="edit" class="tambahProduk" value="Edit"/>
        </div>
    </div>
    </form>
    <form action="#">
    <div class="scroll">
        <table id="riwayat" class="table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $batas=10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1 ;
                    $halaman_awal = ($halaman>1)?($halaman*$batas) - $batas : 0;
                    
                    $previous = $halaman -1;
                    $next = $halaman + 1;

                    $query = "SELECT * FROM unit";
                    $data = mysqli_query($dbConnection, $query);
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data/$batas);
    
                    $query = "SELECT * FROM unit LIMIT $halaman_awal, $batas";
                    $data_unit = mysqli_query($dbConnection, $query);
                    $nomor = $halaman_awal+1; 
                
                    $noUrut=0;
                    if($halaman > 1){
                        $noUrut = ($halaman -1) *10; 
                    }
                    
                    while($row_data = mysqli_fetch_array($data_unit)){
                        $noUrut++;
                        echo "<tr>";
                        echo "<td>". $noUrut."</td>";
                        echo "<td>". $row_data["nama_unit"] ."</td>";
                        //Action
                        echo "<td>";
                        echo "<a href = '../unit/form-unit.php?id=".$row_data['id']."'>Edit</a></td>";
                        echo "<td>";
                        echo "<a href = '../unit/action-hapus-unit.php?id=".$row_data['id']."'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
        <p>
            <label class="jumlahLabel">Jumlah Data: <?php echo $jumlah_data?></label>
        </p>
        <div class="pagination-div">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link"<?php 
                    $startpagination = $halaman;
                    $limitpagination = 9 + $halaman;                      
                    if($halaman > 1){
                        echo "href='?halaman=$previous'";
                    }?>>Previous</a>
                </li>
                <?php 
                    if($halaman > 1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=1">...</a>
                        </li>
                        <?php
                    }
                ?>
                <?php
                    if(isset($_POST['next'])){
                        $startpagination +=1;
                    }              
                    for($x=$startpagination;$x<=$limitpagination;$x++){
                        if($x > ($jumlah_data/$batas))
                        {

                        }else{
                            ?>
                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x?>"><?php echo $x; ?></a></li>
                            <?php
                        }

                    }
                    ?>
                <?php 
                    if($halaman < $total_halaman){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?php echo $total_halaman; ?>">...</a>
                        </li>
                        <?php
                    }
                ?>
                    <li class="page-item">
                        <a name= "next" class="page-link"<?php if($halaman < $total_halaman){echo "href='?halaman=$next'";}?> >Next</a>
                    </li>
            </ul>
        </nav>
        </div>
        <div class="row">
            <div class="buttonField">
            </div>
        </div>
    </form>
    </body>
</html>