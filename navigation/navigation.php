<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../navigation/style-navigation.css"/>

<nav class="navBar">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <h3 class="insideMenu">Menu</h3>
        <a href="../produk/form-produk.php?pencarian=&halaman=1">Daftar Produk</a>
        <a href="../unit/form-unit.php?">Unit Produk</a>
        <a href="../penghitungan_stok/form-penghitungan-stok.php">Penghitungan Stok</a>

      </div>
      
      <span class="spanMenu" onclick="openNav()">&#9776; Menu</span>
      
      <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }
      
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
      </script>
</nav>
</html> 
