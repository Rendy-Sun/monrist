<?php
include("../connection/config.php");
?>
<html>
    <head>
        <title>Monrist</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../invoice_pemesanan/style-form-invoice-pemesanan.css"/>
        <?php
            include("../navigation//navigation.php");
        ?>
    </head>

    <body>
    <div class="header">
        <header><h2>Invoice Pemesanan</h2></header>
    </div>
    <form action="#">
    <div class="row">
        <div class="column-1">
            <header><h2>Detail Total</h2></header>
        </div>
        <div class="column-2">
            <header><h2>Cek Invoice Order</h2></header>
        </div>
    </div>
    <div class="row">
        <div class="subcolumn-1">
            <label>Total Pembelian</label>
        </div>
        <div class="subcolumn-2">
            <input type="text" readonly value ="<?php include("../invoice_pemesanan/fetch-total.php"); echo "Rp ".$rupiah?>">
        </div>
        <div class="subcolumn-3">
            <label>Dari tanggal</label>
        </div>
        <div class="subcolumn-4">
            <input type="date" name="dariTanggal">
        </div>
    </div>
    <div class="row">
        <div class="subcolumn-1">
            <label>Total Per Resi</label>
        </div>
        <div class="subcolumn-2">
            <input type="text" readonly value ="<?php include("../invoice_pemesanan/fetch-total.php"); echo "Rp ".$per_resi?>">
        </div>
        <div class="subcolumn-3">
            <label>Sampai Tanggal</label>
        </div>
        <div class="subcolumn-4">
            <input type="date" name="sampaiTanggal"/>
        </div>
    </div>
    <div class="row">
        <div class="subcolumn-1">
            <label>Total Ongkir</label>
        </div>
        <div class="subcolumn-2">
            <input type="text" readonly value ="<?php include("../invoice_pemesanan/fetch-total.php"); echo "Rp ".$total?>">
        </div>
        <div class="subcolumn-3">
            <input type="submit" name="submit" value="Cek"/>
        </div>
        <div class="subcolumn-4">
        </div>
    </div>
    <div class="scroll">
        <table id="riwayat" class="table" border="1">
            <thead>
                <tr>
                    <th rowspan="2">No</th>          
                    <th rowspan="2">Tanggal Order</th>
                    <th rowspan="2">Tanggal Paket Diambil</th>
                    <th rowspan=2>Nama Toko</th>
                    <th colspan="4">Total Pembelian</th>    
                    <th rowspan="2">Kurs</th>
                    <th rowspan="2">Rupiah</th> 
                    <th rowspan="2">No Resi</th>    
                    <th colspan="2">Ongkir Ke Indonesia</th>  
                    <th colspan="2" rowspan="2">Action</th>  

                </tr>
                <tr>
                    <th>RMB</th>
                    <th>Diskon</th>
                    <th>Ongkir Aplikasi</th>
                    <th>Total</th>
                    <th>Per Resi</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $batas=10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1 ;
                    $halaman_awal = ($halaman>1)?($halaman*$batas) - $batas : 0;
                    $getDariTanggal = isset($_GET['dariTanggal']);
                    $getSampaiTanggal = isset($_GET['sampaiTanggal']);
                    
                    $previous = $halaman -1;
                    $next = $halaman + 1;

                    if(isset($_GET['dariTanggal']) !=null && isset($_GET['sampaiTanggal']) !=null){
                        $getDariTanggal = $_GET['dariTanggal'];
                        $getSampaiTanggal = $_GET['sampaiTanggal'];
                        if($getDariTanggal == null && $getSampaiTanggal == null)
                        {
                            $query = "SELECT * FROM invoice_pemesanan";
                            $data = mysqli_query($dbConnection, $query);
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data/$batas);
        
                            $query = "SELECT * FROM invoice_pemesanan WHERE tanggal_order LIMIT $halaman_awal, $batas";
                            $data_invoice = mysqli_query($dbConnection, $query);
                            $nomor = $halaman_awal+1; 
                        }else{
                            $query = "SELECT * FROM invoice_pemesanan WHERE tanggal_order BETWEEN '$getDariTanggal' AND '$getSampaiTanggal'";
                            $data = mysqli_query($dbConnection, $query);
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data/$batas);
        
                            $query = "SELECT * FROM invoice_pemesanan WHERE tanggal_order BETWEEN '$getDariTanggal' AND '$getSampaiTanggal' LIMIT $halaman_awal, $batas";
                            $data_invoice = mysqli_query($dbConnection, $query);
                            $nomor = $halaman_awal+1;    
                        }
                       
                    }else{
                        $query = "SELECT * FROM invoice_pemesanan";
                        $data = mysqli_query($dbConnection, $query);
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data/$batas);
    
                        $query = "SELECT * FROM invoice_pemesanan WHERE tanggal_order LIMIT $halaman_awal, $batas";
                        $data_invoice = mysqli_query($dbConnection, $query);
                        $nomor = $halaman_awal+1; 
                    }
                    
                
                    $noUrut=0;
                    if($halaman > 1){
                        $noUrut = ($halaman -1) *10; 
                    }
                    
                    while($row_data = mysqli_fetch_array($data_invoice)){
                        $noUrut++;
                        echo "<tr>";
                        echo "<td>". $noUrut."</td>";
                        echo "<td>". $row_data["tanggal_order"] ."</td>";
                        echo "<td>". $row_data["tanggal_paket_diambil"] ."</td>";
                        echo "<td>". $row_data["nama_toko"] ."</td>";
                        echo "<td>". $row_data["rmb"] ."</td>";
                        echo "<td>". $row_data["diskon"] ."</td>";
                        echo "<td>". $row_data["ongkir_aplikasi"] ."</td>";
                        echo "<td>". $row_data["total_pembelian"] ."</td>";
                        echo "<td>". $row_data["kurs"] ."</td>";
                        echo "<td>". $row_data["rupiah"] ."</td>";
                        echo "<td>". $row_data["no_resi"] ."</td>";
                        echo "<td>". $row_data["per_resi"] ."</td>";
                        echo "<td>". $row_data["total_ongkir"] ."</td>";
                        //Action
                        echo "<td>";
                        echo "<a href = 'form-edit-riwayat-pembayaran-kapal.php?id=".$row_data['id']."'>Edit</a></td>";
                        echo "<td>";
                        echo "<a href = 'Action/hapus-riwayat-pembayaran-kapal.php?id=".$row_data['id']."'>Hapus</a>";
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
                        echo "href='?halaman=$previous&dateDari=$dateDari&dateSampai=$dateSampai&submit=Cek#'";
                    }?>>Previous</a>
                </li>
                <?php 
                    if($halaman > 1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=1&dateDari=<?php echo $dateDari?>&dateSampai=<?php echo $dateSampai?>&submit=Cek#">...</a>
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
                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x?>&dateDari=<?php echo $dateDari?>&dateSampai=<?php echo $dateSampai?><?php echo $x; ?></a></li>
                            <?php
                        }

                    }
                    ?>
                <?php 
                    if($halaman < $total_halaman){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?php echo $total_halaman; ?>&dateDari=<?php echo $dateDari?>&dateSampai=<?php echo $dateSampai?>&submit=Cek#">...</a>
                        </li>
                        <?php
                    }
                ?>
                    <li class="page-item">
                        <a name= "next" class="page-link"<?php if($halaman < $total_halaman){echo "href='?halaman=$next&dateDari=$dateDari&dateSampai=$dateSampai&submit=Cek#'";}?> >Next</a>
                    </li>
            </ul>
        </nav>
        </div>
        <div class="row">
            <div class="buttonField">
            <a href="../invoice_pemesanan/form-invoice-pemesanan.php"><input type="button" class="buttonTambah" value="Tambah Invoice"></input></a>
            </div>
        </div>
    </form>
    </body>
</html>