<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input kelas
if ($module=='kelas' AND $act=='input_kelas'){
  $cek_id_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas='$_POST[id_kelas]'");
  $ketemu=mysql_num_rows($cek_id_kelas);
  if (!empty($ketemu)){
             echo "<script>window.alert('ID Kelas sudah ada mohon ulangi.');
            window.history.back();</script>";
        }else{
  mysql_query("INSERT INTO kelas(id_kelas,
                                 nama
								 )
	                       VALUES('$_POST[id_kelas]',
                                '$_POST[nama]'
								)");
                      echo "<script>window.alert('Data Berhasil Ditambah!');
                window.location=(href='../../media_admin.php?module=kelas')</script>";
}
}
elseif ($module=='kelas' AND $act=='hapuskelas'){
  mysql_query("DELETE FROM kelas WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}



elseif ($module=='kelas' AND $act=='update_kelas'){
  mysql_query("UPDATE kelas SET id_kelas = '$_POST[id_kelas]',
                                nama = '$_POST[nama]'
								
                        WHERE id = '$_POST[id]'");
                      echo "<script>window.alert('Data Berhasil Diedit!');
                window.location=(href='../../media_admin.php?module=kelas')</script>";
}


elseif ($module=='kelas' AND $act=='update_kelas_siswa'){
    mysql_query("UPDATE siswa SET id_kelas         = '$_POST[id_kelas]'
                                WHERE  id_siswa    = '$_SESSION[idsiswa]'");

header('location:../../../media_admin?module=kelas');
}

}
?>
