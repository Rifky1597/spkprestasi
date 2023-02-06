<?php
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
if ($module=='siswa' AND $act=='input_siswa'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_siswa/$nama_file";
  
  $cek_nis = mysql_query("SELECT * FROM siswa WHERE nis='$_POST[nis]'");
  $ketemu=mysql_num_rows($cek_nis);

  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  //apabila nis tersedia dan ada foto
  if (empty($ketemu) AND !empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=siswa&act=tambahsiswa')</script>";
        }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=siswa&act=tambahsiswa')</script>";
                }else{
                UploadImage_siswa($nama_file);
                $pass=md5($_POST[password]);
                mysql_query("INSERT INTO siswa(nis,
                                 nama_lengkap,
                                 id_kelas,
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 jenis_kelamin,
                                 agama,
                                 th_masuk,
                                 blokir)
	                       VALUES('$_POST[nis]',
                                '$_POST[nama_lengkap]',
                                '$_POST[id_kelas]',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[th_masuk]',
                                '$_POST[blokir]',");
            }
            
        }
        
                     echo "<script>window.alert('Data Berhasil Ditambah!');
                window.location=(href='../../media_admin.php?module=siswa&act=module=siswa')</script>";
  }
  //apabila nis sudah ada dan foto tidak ada
  elseif(!empty($ketemu) AND empty($lokasi_file)){
      echo "<script>window.alert('nis sudah digunakan mohon ulangi.');
            window.location=(href='../../media_admin.php?module=siswa&act=tambahsiswa')</script>";
      }
  //apablia nis tersedia dan foto tidak ada
  elseif(empty($ketemu) AND empty($lokasi_file)){
    $pass=md5($_POST[password]);
    mysql_query("INSERT INTO siswa(nis,
                                 nama_lengkap,
                                 id_kelas,
                             
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 jenis_kelamin,
                                 agama,
                                 th_masuk,
                                 blokir)
	                       VALUES('$_POST[nis]',
                                '$_POST[nama_lengkap]',
                                '$_POST[id_kelas]',
                               
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[th_masuk]',
                                '$_POST[blokir]')");
                     echo "<script>window.alert('Data Berhasil Ditambah!');
                window.location=(href='../../media_admin.php?module=siswa&act=module=siswa')</script>";
    }else{
       echo "<script>window.alert('nis sudah digunakan mohon ulangi.');
                window.location=(href='../../media_admin.php?module=siswa&act=tambahsiswa')</script>";
    }
}
 //updata siswa
 elseif ($module=='siswa' AND $act=='update_siswa'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_siswa/$nama_file";

  $tgl_lahir=$_POST['thn'].'-'.$_POST['bln'].'-'.$_POST['tgl'];

  $cek_nis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
  $ketemu=mysql_fetch_array($cek_nis);

  if($_POST['nis']==$ketemu['nis']){

   //apabila foto tidak diubah dan password tidak di ubah
  if (empty($lokasi_file) AND empty($_POST['password'])){
      mysql_query("UPDATE siswa SET
                        
                                  nama_lengkap    = '$_POST[nama]',
                                  id_kelas        = '$_POST[id_kelas]',
                                  
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  blokir          = '$_POST[blokir]'
                           WHERE  id_siswa        = '$_POST[id]'");
  
  }
  //apabila foto diubah dan password tidak diubah
  elseif(!empty($lokasi_file) AND empty($_POST['password'])){
	 
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=siswa')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../media_admin.php?module=siswa')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r['foto'])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);
            
            UploadImage_siswa($nama_file);
			echo $_POST['nis'];
            mysql_query("UPDATE siswa SET
                                  nama_lengkap    = '$_POST[nama]',
                                  id_kelas        = '$_POST[id_kelas]',
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  blokir          = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
            }else{
				 echo $nama_file;
                UploadImage_siswa($nama_file);
                mysql_query("UPDATE siswa SET
                                  nama_lengkap    = '$_POST[nama]',
                                  username_login  = '$_POST[username]',
                                  id_kelas        = '$_POST[id_kelas]',
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  foto             = '$nama_file'
                                 
                           WHERE  id_siswa         = '$_POST[id]'");
            }
         }
         }
  }
  //apabila foto tidak diubah dan password diubah
  elseif(empty($lokasi_file) AND !empty($_POST['password'])){
      $pass=md5($_POST['password']);
      mysql_query("UPDATE siswa SET
                                 nama_lengkap    = '$_POST[nama]',  
                                  id_kelas        = '$_POST[id_kelas]',
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
  }else{
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=siswa')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                echo "<script>window.alert('Tipe File tidak di ijinkan.');
                window.location=(href='../../media_admin.php?module=siswa')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);
            if(!empty($r['foto'])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);

            UploadImage_siswa($nama_file);
            mysql_query("UPDATE siswa SET                                 
                                  nama_lengkap    = '$_POST[nama]',
				  id_kelas        = '$_POST[id_kelas]',
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
            }
            else{
               UploadImage_siswa($nama_file);
               mysql_query("UPDATE siswa SET
                             
                                  nama_lengkap    = '$_POST[nama]',
                                  id_kelas        = '$_POST[id_kelas]',
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                           WHERE  id_siswa        = '$_POST[id]'");
            }
            }
         }
  }
                     echo "<script>window.alert('Data Berhasil Diedit!');
                window.location=(href='../../media_admin.php?module=siswa&act=module=siswa')</script>";
  }
  elseif($_POST['nis']!= $ketemu['nis']){
      $cek_nim = mysql_query("SELECT * FROM siswa WHERE nis = '$_POST[nis]'");
      $c = mysql_num_rows($cek_nim);
      //apabila nis tersedia
      if(empty($c)){
          //apabila foto tidak diubah dan password tidak di ubah
  if (empty($lokasi_file)){
      mysql_query("UPDATE siswa SET
                                  nis  = '$_POST[nis]',
                                  nama_lengkap    = '$_POST[nama]',
                                  username_login  = '$_POST[username]',
                                  id_kelas        = '$_POST[id_kelas]',
                                  
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  blokir          = '$_POST[blokir]'
                           WHERE  id_siswa        = '$_POST[id]'");

  }
  //apabila foto diubah dan password tidak diubah
  elseif(!empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=siswa')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../media_admin.php?module=siswa')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r[foto])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);

            UploadImage_siswa($nama_file);
            mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',
                                  id_kelas         = '$_POST[id_kelas]',
                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  blokir           = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
            }else{
                UploadImage_siswa($nama_file);
                mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',
                                  username_login   = '$_POST[username]',
                                  id_kelas         = '$_POST[id_kelas]',
                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  blokir           = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
            }
         }
         }
  }
  //apabila foto tidak diubah dan password diubah
  elseif(empty($lokasi_file)){
      mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',
                                  id_kelas         = '$_POST[id_kelas]',    
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  blokir           = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
  }else{
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=siswa')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                echo "<script>window.alert('Tipe File tidak di ijinkan.');
                window.location=(href='../../media_admin.php?module=siswa')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);
            if(!empty($r[foto])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);

            UploadImage_siswa($nama_file);
            $pass=md5($_POST[password]);
            mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',
                                  id_kelas         = '$_POST[id_kelas]',            
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  blokir           = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
            }
            else{
               UploadImage_siswa($nama_file);
               mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',
                                  id_kelas         = '$_POST[id_kelas]',         
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  blokir           = '$_POST[blokir]'
                           WHERE  id_siswa         = '$_POST[id]'");
            }
            }
         }
  }
                     echo "<script>window.alert('Data Berhasil Diedit!');
                window.location=(href='../../media_admin.php?module=siswa&act=module=siswa')</script>";
    }
      else{
        echo "<script>window.alert('nis sudah pernah digunakan.');
        window.location=(href='../../media_admin.php?module=siswa')</script>";
      }
  }
}

elseif ($module=='siswa' AND $act=='update_kelas_siswa'){
    mysql_query("UPDATE siswa SET id_kelas         = '$_POST[id_kelas]'
                                WHERE  id_siswa    = '$_SESSION[idsiswa]'");

                     echo "<script>window.alert('Data Berhasil Diedit!');
                window.location=(href='../../media_admin.php?module=siswa&act=module=kelas')</script>";
}

//Hapus Siswa
elseif ($module=='siswa' AND $act=='hapus'){
  mysql_query("DELETE FROM siswa WHERE id_siswa = '$_GET[id]'");
  mysql_query("DELETE FROM tbl_klasifikasi WHERE id_siswa = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='siswa' AND $act=='update_profil_siswa'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_siswa/$nama_file";

  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  $cek_nim = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
  $ketemu=mysql_fetch_array($cek_nim);

  if($_POST['nis']==$ketemu['nis']){

   //apabila foto tidak diubah
  if (empty($lokasi_file)){
      mysql_query("UPDATE siswa SET
                                  nis  = '$_POST[nis]',
                                  nama_lengkap    = '$_POST[nama]',                                  
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                           WHERE  id_siswa        = '$_POST[id]'");

  }
  //apabila foto diubah
  elseif(!empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../../media_admin?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../../media_admin.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r[foto])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);

            UploadImage_siswa($nama_file);
            mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
            }else{
                UploadImage_siswa($nama_file);
                mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir     = '$_POST[tempat_lahir]',
                                  tgl_lahir        = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama            = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
            }
         }
         }
  }
  header('location:../../../media_admin.php?module=siswa&act=detailprofilsiswa&id='.$_SESSION[idsiswa]);
  }
  elseif($_POST['nis']!= $ketemu['nis']){
      $cek_nim = mysql_query("SELECT * FROM siswa WHERE nis = '$_POST[nis]'");
      $c = mysql_num_rows($cek_nim);
      //apabila nis tersedia
      if(empty($c)){
          //apabila foto tidak diubah
  if (empty($lokasi_file)){
      mysql_query("UPDATE siswa SET
                                  nis  = '$_POST[nis]',
                                  nama_lengkap    = '$_POST[nama]',                                  
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk        = '$_POST[th_masuk]',
                           WHERE  id_siswa        = '$_POST[id]'");

  }
  //apabila foto diubah
  elseif(!empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../../media_admin.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../../media_admin.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r[foto])){
            $img = "../../../foto_siswa/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_siswa/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_siswa/small_$r[foto]";
            unlink($img3);

            UploadImage_siswa($nama_file);
            mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
            }else{
                UploadImage_siswa($nama_file);
                mysql_query("UPDATE siswa SET
                                  nis              = '$_POST[nis]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenim_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  th_masuk         = '$_POST[th_masuk]',
                           WHERE  id_siswa         = '$_POST[id]'");
            }
         }
         }
  }
  header('location:../../../media_admin.php?module=siswa&act=detailprofilsiswa&id='.$_SESSION[idsiswa]);
    }
      else{
        echo "<script>window.alert('nis sudah pernah digunakan.');
        window.location=(href='../../../media_admin.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]')</script>";
      }
  }
}

}
?>
