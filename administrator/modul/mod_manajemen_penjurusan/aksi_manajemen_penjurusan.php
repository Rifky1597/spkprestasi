<?php
ob_start();
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/fungsi_thumb.php";
include "../../../configurasi/library.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input admin
if ($module=='manajemen_penjurusan' AND $act=='input_manajemen_penjurusan'){
  mysql_query("INSERT INTO admin(username,
                                 password,
                                 nama_lengkap,
                                 alamat,
                                 email, 
                                 no_telp,
								 level,
                                 blokir,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[alamat]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$_POST[level]',
                                '$_POST[blokir]',
                                '$pass')");
  echo "<script> alert ('Data Berhasil Diubah')</script>";
  header('location:../../media_admin.php?module='.$module);
                   
}

// Update penjurusan
elseif ($module=='manajemen_penjurusan' AND $act=='update_manajemen_penjurusan'){
  

    mysql_query("UPDATE jurusan SET nama_jurusan = '$_POST[nama_jurusan]',
                                  jumlah = '$_POST[jumlah]' WHERE id_jurusan = '$_POST[id_jurusan]'");
  }
  header('location:../../media_admin.php?module='.$module);
}
?>
