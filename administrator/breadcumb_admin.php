<?php
include "../configurasi/koneksi.php";

if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
      echo "<span class='judulhead'><b>Selamat Datang Admin</b></span>";
  }
}
elseif ($_GET['module']=='modul'){
      echo "<span class='judulhead'><b>Manajeman Modul</b></span>";
  }
elseif ($_GET['module']=='admin'){
      echo "<span class='judulhead'><b>Manajeman Admin</b></span>";
  }
elseif ($_GET['module']=='siswa'){
      echo "<span class='judulhead'><b>Manajeman Siswa</b></span>";
  }
elseif ($_GET['module']=='kelas'){
      echo "<span class='judulhead'><b>Manajeman Kelas</b></span>";
  }
elseif ($_GET['module']=='kriteria'){
      echo "<span class='judulhead'><b>Manajeman Kriteria</b></span>";
  }
elseif ($_GET['module']=='materi'){
      echo "<span class='judulhead'><b>Manajeman Materi</b></span>";
  }
elseif ($_GET['module']=='quiz'){
      echo "<span class='judulhead'><b>Manajeman Quiz</b></span>";
  }

elseif ($_GET['module']=='templates'){
      echo "<span class='judulhead'><b>Manajeman Template</b></span>";
  }


elseif($_GET['module']=='daftarsiswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]'");
        $s=mysql_fetch_array($siswa);
	echo "<span class='judulhead'><b>Manajeman Kelas &#187; Daftar Siswa</b></span>";
}

?>
