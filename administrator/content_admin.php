<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>



<?php
include "../configurasi/koneksi.php";
include "../configurasi/library.php";
include "../configurasi/fungsi_indotgl.php";
include "../configurasi/fungsi_combobox.php";
include "../configurasi/class_paging.php";

$aksi_kelas="modul/mod_kelas/aksi_kelas.php";
$aksi_mapel="modul/mod_matapelajaran/aksi_matapelajaran.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
	?>
	  <!-- Small boxes (Stat box) -->
	
		<div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Dashboard</h3>
        </div>	
	   <div class="box-body">
			<div class="row">
				<div class="callout callout-warning"  style="margin:20px 20px 20px 20px">
					<!-- <h4><?php echo "Selamat Datang, $_SESSION[namalengkap]"; ?></h4> -->
	<center>
    <b>
      <h1><?php echo "Sistem Penunjang Keputusan Pemilihan Siswa Berprestasi"; ?></h4>
			<h1><?php echo "Dengan Metode Weighted Product (WP)";?></h4>
			<h1><?php echo "(Studi Kasus : SMA Negeri 2 Sampit)";?></h4>
      </b>
	</center>
				</div>
        <div class="col-lg-1 col-xs-2"></div>
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<?php $siswa = mysql_num_rows(mysql_query("SELECT * FROM siswa")); ?>
							<h3><?php echo $siswa; ?></h3>
							<p>Peserta Didik</p>
						</div>
						<div class="icon">
							<i class="fa fa-graduation-cap"></i>
						</div>
						<a href="?module=siswa" class="small-box-footer">Klik disini <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<?php $kelas = mysql_num_rows(mysql_query("SELECT * FROM kelas")); ?>
							<h3><?php echo $kelas; ?></h3>
							<p>Kelas</p>
						<div class="icon" >
              <i class="fa fa-group"></i>
            </div>
            </div>
						<a href="?module=kelas" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<?php $kriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria")); ?>
							<h3><?php echo $kriteria; ?></h3>
							<p>Kriteria</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="?module=kriteria" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
     
				
		</div>
	 
  <?php
  
  }
}
// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}
// Bagian user admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}

// Bagian kelas
elseif ($_GET['module']=='kelas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kelas/kelas.php";
  }

}

// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='daftarsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='detailsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='detailsiswapengajar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian mata pelajaran
elseif ($_GET['module']=='kriteria'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kriteria/kriteria.php";
  }
  else{
      include "modul/mod_kriteria/kriteria.php";
  }
}

// Bagian klasifikasi
elseif ($_GET['module']=='klasifikasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_klasifikasi/klasifikasi.php";
  }
  else{
      include "modul/mod_klasifikasi/klasifikasi.php";
  }
}



// Bagian mata pelajaran
elseif ($_GET['module']=='nilai'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_nilai/nilai.php";
  }
  else{
      include "modul/mod_nilai/nilai.php";
  }
}

elseif ($_GET['module']=='analisa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_analisa/analisa.php";
  }
  else{
      include "modul/mod_analisa/analisa.php";
  }
}

elseif ($_GET['module']=='analisasaw'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_analisa/analisasaw.php";
  }
  else{
      include "modul/mod_analisa/analisasaw.php";
  }
}

// elseif ($_GET['module']=='penjurusan'){
//   if ($_SESSION['leveluser']=='admin'){
//     include "modul/mod_penjurusan/penjurusan.php";
//   }
//   else{
//       include "modul/mod_penjurusan/penjurusan.php";
//   }
// }

elseif ($_GET['module']=='rankingkelas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_rankingkelas/rankingkelas.php";
  }
  else{
      include "modul/mod_rankingkelas/rankingkelas.php";
  }
}

elseif ($_GET['module']=='hasilwp'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hasilwp/hasilwp.php";
  }
  else{
      include "modul/mod_hasilwp/hasilwp.php";
  }
}

elseif ($_GET['module']=='import'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_import/import.php";
  }
  else{
      include "modul/mod_import/import.php";
  }
}
?>
