<?php
error_reporting(0);
$server = "localhost";
$user = "root";
$password = "";
$database = "spkprestasi";
set_time_limit(1800);
mysql_connect($server,$user,$password) or die ("Koneksi gagal");
mysql_select_db($database) or die ("Database tidak ditemukan");
?>
