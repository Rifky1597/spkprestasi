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

$module=$_GET['module'];
$act=$_GET['act'];

// Input mapel
if ($module=='kriteria' AND $act=='input_kriteria'){
    mysql_query("INSERT INTO tbl_kriteria(kriteria,
                                 bobot
								 )
	                       VALUES('$_POST[nm_kriteria]',
                                '$_POST[bobot]')");
                     echo "<script>window.alert('Kriteria Berhasil Ditambah!');
                window.location=(href='../../media_admin.php?module=kriteria')</script>";
}


if ($module=='kriteria' AND $act=='input_himpunan'){
    mysql_query("INSERT INTO tbl_himpunankriteria(id_kriteria,nama,keterangan, 
                                 nilai
								 )
	                       VALUES(
								'$_POST[id_kriteria]',
								'$_POST[nama]',
								'$_POST[ket]',
                                '$_POST[nilai]')");
      echo "<script> alert ('Kriteria Berhasil Ditambah')</script>";
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_POST['id_kriteria']);
}



elseif ($module=='kriteria' AND $act=='update_kriteria'){
   mysql_query("UPDATE tbl_kriteria SET kriteria  = '$_POST[nm_kriteria]',
                                          bobot   = '$_POST[bobot]' WHERE id='$_POST[id]'");
                     echo "<script>window.alert('Kriteria Berhasil Diedit!');
                window.location=(href='../../media_admin.php?module=kriteria')</script>";
}



elseif ($module=='kriteria' AND $act=='update_himpunan'){
   mysql_query("UPDATE tbl_himpunankriteria SET nama  = '$_POST[nama]',keterangan  = '$_POST[ket]',  
											nilai   = '$_POST[nilai]' WHERE id_hk='$_POST[id_hk]'");
     echo "<script> alert ('Himpunan Kriteria Berhasil Diubah')</script>";
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_POST['id_kriteria']);
}




elseif ($module=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_kriteria WHERE id = '$_GET[id]'");
  mysql_query("DELETE FROM tbl_himpunankriteria WHERE id_kriteria = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kriteria' AND $act=='hapus_himpunan'){
  mysql_query("DELETE FROM tbl_himpunankriteria WHERE id_hk = '$_GET[id]'");
  
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_GET['id_kriteria']);
}

elseif ($module=='kriteria' AND $act=='input_klasifikasi'){
  mysql_query("DELETE FROM tbl_klasifikasi WHERE id_siswa = '$_POST[id_siswa]'");
  
  $jumkriteria = $_POST['jumkriteria'];
  echo $jumkriteria;
  
  for ($i=1; $i<=$jumkriteria; $i++)
	{
		$idhk = $_POST['id_hk'.$i];
		//$idhk = $_POST['idhk'.$i];
		
		echo $idhk.'<br>';
		
		mysql_query("INSERT INTO tbl_klasifikasi(id_siswa,id_hk)
	                       VALUES('$_POST[id_siswa]','$idhk')");
	}
                     echo "<script>window.alert('klasifikasi Berhasil Ditambah!');
                window.location=(href='../../media_admin.php?module=kriteria&act=klasifikasi')</script>";
}
}
?>
