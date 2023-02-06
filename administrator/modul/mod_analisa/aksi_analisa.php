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

$module=$_GET[module];
$act=$_GET[act];
$tahun = date('Y');
// input rank
if ($module=='analisa' AND $act=='input'){
mysql_query("TRUNCATE TABLE ranking");
$jumsiswa = $_POST['jumsiswa'];
  echo $jumsiswa;
  
  for ($i=1; $i<=$jumsiswa; $i++)
	{
		$nis = $_POST['nis'.$i];
    $nama_lengkap = $_POST['nama_lengkap'.$i];
    $total_nilai = $_POST['total_nilai'.$i];  
		//$idhk = $_POST['idhk'.$i];
		
		echo $nis.'<br>';
		echo $nama_lengkap.'<br>';
    echo $total_nilai.'<br>'; 
                
		mysql_query("INSERT INTO ranking(nis,
                                 nama_lengkap,
                                 vektor_s,
                                 tahun)
	                       VALUES('$nis',
                                '$nama_lengkap',
                                '$total_nilai',
                                '$tahun')");
  
		
	}
                     echo "<script>window.alert('Data Berhasil Diproses!');
                window.location=(href='../../media_admin.php?module=analisa')</script>";
  }

elseif ($module=='analisa' AND $act=='inputvektor'){
mysql_query("TRUNCATE TABLE ranking");
$jumsiswa = $_POST['jumsiswa'];
  echo $jumsiswa;
  
  for ($i=1; $i<=$jumsiswa; $i++)
	{
		$nis = $_POST['nis'.$i];
                $nama_lengkap = $_POST['nama_lengkap'.$i];
                $total_nilai = $_POST['total_nilai'.$i];
                $total_nilai2 = $_POST['total_nilai2'.$i];
		//$idhk = $_POST['idhk'.$i];
		
		echo $nis.'<br>';
		echo $nama_lengkap.'<br>';
                echo $total_nilai.'<br>';
                
                
		mysql_query("INSERT INTO ranking(nis,
                                 nama_lengkap,
                                 vektor_s,
                                 vektor_v,
                                 tahun)
	                       VALUES('$nis',
                                '$nama_lengkap',
                                '$total_nilai',
                                '$total_nilai2',
                                '$tahun')");

				mysql_query("INSERT INTO rankingtahun(nis,
                                 nama_lengkap,
                                 vektor_s,
                                 vektor_v,
                                 tahun)
	                       VALUES('$nis',
                                '$nama_lengkap',
                                '$total_nilai',
                                '$total_nilai2',
                                '$tahun')");
  
		
	}
                     echo "<script>window.alert('Data Berhasil Diproses!');
                window.location=(href='../../media_admin.php?module=analisa')</script>";
  }

// Update kriteria
elseif ($module=='analisa' AND $act=='update'){
    mysql_query("UPDATE analisa SET id_kriteria = '$_POST[id_kriteria]',
                        nama = '$_POST[nama]',
                        keterangan = '$_POST[keterangan]',
                        nilai = '$_POST[nilai]' where id_hk='$_POST[id_hk]' ");

  header('location:../../media_admin.php?module='.$module);
  }
}
?>
