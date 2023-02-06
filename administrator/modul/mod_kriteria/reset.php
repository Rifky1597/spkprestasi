<?php
session_start();
ob_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";


  mysql_query("TRUNCATE tbl_klasifikasi");
  
                     echo "<script>window.alert('Data Berhasil Direset!');
                window.location=(href='../../media_admin.php?module=klasifikasi&act=klasifikasi')</script>";
}

?>
