<?php
ob_start();
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];
//$tanggal = date("Y-m-d");
//$jam = date("H:i:s");
// Hapus kriteria
if ($module=='klasifikasi' AND $act=='hapus'){
     mysql_query("DELETE FROM klasifikasi WHERE id_hk='$_GET[id]'");
  header('location:../../media_admin?module='.$module.'&act=listklasifikasi&id='.$_POST['id_kriteria']);
}

// Input klasifikasi
elseif ($module=='klasifikasi' AND $act=='input'){

$jumkriteria = $_POST['jumkriteria'];
  echo $jumkriteria;
  
  for ($i=1; $i<=$jumkriteria; $i++)
	{
		$idhk = $_POST['id_hk'.$i];
		//$idhk = $_POST['idhk'.$i];
		
		echo $idhk.'<br>';
		
		mysql_query("INSERT INTO klasifikasi(id_siswa,
                                 id_hk)
	                       VALUES('$_POST[id_siswa]',
                                '$idhk')");
  
		
	}
  header('location:../../media_admin?module=klasifikasi');
  }


// Update kriteria
elseif ($module=='klasifikasi' AND $act=='update'){
    mysql_query("UPDATE klasifikasi SET id_kriteria = '$_POST[id_kriteria]',
                        nama = '$_POST[nama]',
                        keterangan = '$_POST[keterangan]',
                        nilai = '$_POST[nilai]' where id_hk='$_POST[id_hk]' ");

  header('location:../../media_admin?module='.$module);
  }
}
?>
