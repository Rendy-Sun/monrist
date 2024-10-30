<?php
include("../connection/config.php");
?>
<html>
    <head>
        <title>Monrist</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../produk/style-form-produk.css"/>
        <?php
            include("../navigation/navigation.php");
        ?>
    </head>

    <body>
    <div class="header">
        <header><h2>Daftar Produk</h2></header>
    </div>
    <form action="../produk/action-tambah-produk.php" method="POST">
    <div class="row">
        <div class="subcolumn-1">
            <label>Nama Produk</label>
        </div>
        <div class="subcolumn-2">
            <input type="text" name="nama_produk" required>
            <button id="openPopup" class="btnPopUp">Add Image</button>
            <div id="popup" class="popup">
                <div class="popup-content">
                    <input type="text" id="input" name="img_url" placeholder="Paste Image URL Here (Optional)">
                    <input type="button" id="closePopup" class="btnClosePopUp" value="Add">    
                </div>
            </div>
            <link rel="stylesheet" href="../produk/style-pop-up.css">
            <script src="../produk/script-pop-up.js"></script>
        </div>
        <div class="subcolumn-3">
            <label>Harga Produk</label>
        </div>
        <div class="subcolumn-4">
            <input type="number" name="harga_produk" required>
        </div>
    </div>
    <div class="row">
        <div class="subcolumn-1">
            <label>Unit Produk</label>
        </div>
        <div class="subcolumn-2">
            <select name="unit_produk" required>
                <option value ="" hidden>Pilih Unit Produk</option>
                <?php
                    $query2 = "SELECT nama_unit FROM unit";
                    $result2 = $dbConnection->query($query2);
                    while($row_data = mysqli_fetch_array($result2)){
                        echo '<option value="'.$row_data['nama_unit'].'">'.$row_data['nama_unit'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="subcolumn-3">
            <input type="submit" name="submit" class="tambahProduk" value="Tambah Produk"/>
        </div>
    </div>
    </form>
    <form action="#">
    <div class="subcolumn-5">
        <input type="text" name="pencarian" placeholder="Search Produk">
        <input type="submit" value="Cari" name="cari" class="pencarian">
    </div>
    <div class="scroll">
        <table id="riwayat" class="table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Per Unit</th>
                    <th>Stok</th>
                    <th>Unit</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $batas=10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1 ;
                    $halaman_awal = ($halaman>1)?($halaman*$batas) - $batas : 0;
                    $pencarian = $_GET['pencarian'];
                    
                    $previous = $halaman -1;
                    $next = $halaman + 1;

                    if($pencarian == null){
                        $query = "SELECT * FROM produk INNER JOIN unit ON unit.id = produk.unit_id";
                        $data = mysqli_query($dbConnection, $query);
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data/$batas);
    
                        $query = "SELECT nama_produk, harga, nama_unit, produk.id AS id_produk, stok, img_url FROM produk INNER JOIN unit ON unit.id = produk.unit_id LIMIT $halaman_awal, $batas";
                        $data_produk = mysqli_query($dbConnection, $query);
                        $nomor = $halaman_awal+1; 
                    }else if($pencarian !=null){
                        $query = "SELECT * FROM produk INNER JOIN unit ON unit.id = produk.unit_id WHERE nama_produk LIKE '%".$pencarian."%'";
                        $data = mysqli_query($dbConnection, $query);
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data/$batas);
    
                        $query = "SELECT nama_produk, harga, nama_unit, produk.id AS id_produk, stok, img_url FROM produk INNER JOIN unit ON unit.id = produk.unit_id WHERE nama_produk LIKE '%".$pencarian."%' LIMIT $halaman_awal, $batas";
                        $data_produk = mysqli_query($dbConnection, $query);
                        $nomor = $halaman_awal+1; 
                    }
                
                    $noUrut=0;
                    if($halaman > 1){
                        $noUrut = ($halaman -1) *10; 
                    }
                    
                    while($row_data = mysqli_fetch_array($data_produk)){
                        $noUrut++;
                        $img = $row_data['img_url'];
                        $harga_produk = number_format($row_data["harga"],0,'','.');
                        echo "<tr>";
                        echo "<td>". $noUrut."</td>";
                        echo "<td><a href='$img'><img src='$img' width='100' height='100'></a></td>";
                        echo "<td>". $row_data["nama_produk"] ."</td>";
                        echo "<td>Rp ". $harga_produk ."</td>";
                        echo "<td>". $row_data["stok"] ."</td>";
                        echo "<td>". $row_data["nama_unit"] ."</td>";
                        //Action
                        echo "<td>";
                        echo "<a href = '../produk/form-edit-produk.php?id=".$row_data['id_produk']."'>Edit</a></td>";
                        echo "<td>";
                        echo "<a href = '../produk/action-hapus-produk.php?id=".$row_data['id_produk']."'>Hapus</a>";
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
                        echo "href='?halaman=$previous&pencarian=$pencarian&submit=Cek#'";
                    }?>>Previous</a>
                </li>
                <?php 
                    if($halaman > 1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=1&pencarian=&submit=Cek#">...</a>
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
                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x?>&pencarian=<?php echo $pencarian;?>&submit=Cek#"><?php echo $x; ?></a></li>
                            <?php
                        }

                    }
                    ?>
                <?php 
                    if($halaman < $total_halaman){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?php echo $total_halaman; ?>&pencarian=<?php echo $pencarian?>&submit=Cek#">...</a>
                        </li>
                        <?php
                    }
                ?>
                    <li class="page-item">
                        <a name= "next" class="page-link"<?php if($halaman < $total_halaman){echo "href='?halaman=$next&pencarian=$pencarian&submit=Cek#'";}?> >Next</a>
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