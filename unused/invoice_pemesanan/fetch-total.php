<?php
    $query = "SELECT SUM(rupiah) AS rupiah, SUM(per_resi) AS per_resi FROM invoice_pemesanan";
    $result = $dbConnection->query($query);
    $data = mysqli_fetch_array($result);
    $rupiah = $data['rupiah'];
    $per_resi = $data['per_resi'];

    $total = $rupiah + $per_resi;

    
?>