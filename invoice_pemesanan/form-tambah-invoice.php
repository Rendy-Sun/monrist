<?php
    include("../connection/config.php")
?>
<html>
    <head>
        <title>Pembayaran Majestic Ferry</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style-form-tambah-invoice.css"/>
        <?php
            include("../navigation/navigation.php");
        ?>
    </head>
    <body>
        <form action="action-tambah-invoice.php" method="POST">
            <div class="container">
            <header><h1>Pembayaran Kapal</h1></header>
                <div class="row">
                    <div class="col-25">
                        <label>Tanggal Order </label>
                    </div>
                    <div class="col-75">
                        <select id="nama_kapal" name="nama_kapal"required>
                            <option hidden value="">Pilih Nama Kapal</option>
                            <?php
                                include("Fetch_Data/nama-kapal-option.php");
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Tanggal Paket Di ambil </label>           
                    </div>
                    <div class="col-75">

                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Nama Toko </label>
                    </div>
                    <div class="col-75">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>RMB </label>  
                    </div>
                    <div class="col-75">
                        <select name="status_pembayaran" required>
                            <?php
                                include("Fetch_Data/status-pembayaran-option.php");
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Harga Pembayaran </label>
                    </div>
                    <div class="col-75">
                        <input type="number" name="harga" id="harga" required placeholder="0" readonly="readonly"/>
                    </div>
                    <input type="button" class="changeButton" value="Change" onclick="document.getElementById('harga').readOnly=false;"/>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Tanggal Pembayaran </label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="tanggal_transaksi" required value="<?php $dt=new DateTime(); echo $dt->format('Y-m-d'); ?>"/>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Bukti Pembayaran (Optional) </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="bukti_pembayaran">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label>Catatan Pembayaran </label>
                    </div>
                    <div class="col-75">
                        <textarea name="catatan_pembayaran"></textarea>
                    </div>
                </div>
                <div class="row">
                    <a href="form-riwayat-pembayaran-kapal.php"><input type="button" class="riwayatButton" value="Riwayat"></a>
                    <input type="submit" class="submitTambah" name="submitTambahPembayaranKapal" value="Tambah" onclick="if(document.getElementById('nama_kapal').value=='' && document.getElementById('tujuan_pembayaran').value==''){alert('Nama Kapal dan Tujuan Pembayaran Wajib diisi!');}"/>
                </div>
            </div>
        </form>
    </body>
</html>