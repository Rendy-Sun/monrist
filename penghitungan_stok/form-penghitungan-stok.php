<?php
include("../connection/config.php");
?>
<html>
    <head>
        <title>Monrist</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../penghitungan_stok/style-form-penghitungan-stok.css"/>
        <?php
            include("../navigation/navigation.php");
        ?>
    </head>

    <body>
    <div class="header">
        <header><h2>Penghitungan Stok</h2></header>
    </div>
    <form action="../penghitungan_stok/action-tambah-penghitungan.php" method="POST">
    <div class="row">
        <div class="subcolumn-1">
            <label>Nama Produk</label>
        </div>
        <div class="subcolumn-2">
            <select name="nama_produk" required>
            <option value="" hidden>Pilih Nama Produk</option>
            <?php 
                $query = "SELECT nama_produk FROM produk";
                $result = $dbConnection->query($query);
                while($row = mysqli_fetch_array($result)){
                    echo '<option value="'.$row['nama_produk'].'">'.$row['nama_produk'].'</option>';
                }
            ?>                            
            </select>
        </div>
        <div class="subcolumn-3">
            <label>Stok Masuk</label>
        </div>
        <div class="subcolumn-4">
            <input type="number" name="stok_masuk" placeholder="0" required>
        </div>
    </div>
    <div class="row">
        <div class="subcolumn-1">
            <label>Stok Keluar</label>
        </div>
        <div class="subcolumn-2">
            <input type="number" name="stok_keluar" placeholder="0" required>
        </div>
        <div class="subcolumn-3">
            <label>Tanggal</label>
        </div>
        <div class="subcolumn-4">
            <input type="date" name="tanggal" value="<?php $dt=new DateTime(); echo $dt->format('Y-m-d'); ?>">
            <input type="submit" value="Kirim" name="submit" class="kirim">
        </div>
    </div>
    </form>
    <div class="scroll">
        <table id="riwayat" class="table" border="1">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Nama Produk</th>
                    <th rowspan="2">Harga Per Unit</th>
                    <th rowspan="2">Unit Produk</th>
                    <th colspan="2">Stok Masuk</th>
                    <th colspan="2">Stok Keluar</th>
                    <th colspan="1">Sisa Stok</th>
                    <th colspan="2" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th>Jumlah Masuk</th>
                    <th>Total Harga Masuk</th>
                    <th>Jumlah Keluar</th>
                    <th>Total Harga Keluar</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $batas=10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1 ;
                    $halaman_awal = ($halaman>1)?($halaman*$batas) - $batas : 0;
                    
                    $previous = $halaman -1;
                    $next = $halaman + 1;

                    $query = "SELECT stok_produk.id AS id_stok_produk, tanggal, nama_produk, harga, nama_unit, jumlah_masuk, total_harga_masuk, jumlah_keluar, total_harga_keluar, sisa_stok, harga_sisa_stok FROM stok_produk INNER JOIN produk ON produk.id = stok_produk.produk_id INNER JOIN unit ON produk.unit_id = unit.id";
                    $data = mysqli_query($dbConnection, $query);
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data/$batas);
    
                    $query = "SELECT stok_produk.id AS id_stok_produk, tanggal, nama_produk, harga, nama_unit, jumlah_masuk, total_harga_masuk, jumlah_keluar, total_harga_keluar, sisa_stok, harga_sisa_stok FROM stok_produk INNER JOIN produk ON produk.id = stok_produk.produk_id INNER JOIN unit ON produk.unit_id = unit.id ORDER BY tanggal DESC LIMIT $halaman_awal, $batas";
                    $data_stok = mysqli_query($dbConnection, $query);
                    $nomor = $halaman_awal+1; 
                
                    $noUrut=0;
                    if($halaman > 1){
                        $noUrut = ($halaman -1) *10; 
                    }
                    
                    while($row_data = mysqli_fetch_array($data_stok)){
                        $noUrut++;
                        echo "<tr>";
                        echo "<td>". $noUrut."</td>";
                        echo "<td>". $row_data["tanggal"] ."</td>";
                        echo "<td>". $row_data["nama_produk"] ."</td>";
                        echo "<td>Rp ". number_format($row_data["harga"],0,'','.') ."</td>";
                        echo "<td>". $row_data["nama_unit"] ."</td>";
                        echo "<td>". $row_data["jumlah_masuk"] ."</td>";
                        echo "<td>Rp ". number_format($row_data["total_harga_masuk"],0,'','.') ."</td>";
                        echo "<td>". $row_data["jumlah_keluar"] ."</td>";
                        echo "<td>Rp ". number_format($row_data["total_harga_keluar"],0,'','.') ."</td>";
                        echo "<td>Rp ". number_format($row_data["harga_sisa_stok"],0,'','.') ."</td>";
                        //Action
                        echo "<td>";
                        echo "<a href = '#'>Edit</a></td>";
                        echo "<td>";
                        echo "<a href = '../penghitungan_stok/action-hapus-penghitungan.php?id=".$row_data['id_stok_produk']."'>Hapus</a>";
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
                            <a class="page-link" href="?halaman=1=Cek#">...</a>
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