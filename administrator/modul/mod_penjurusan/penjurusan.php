<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showsiswa()
 {
 <?php

 // membaca semua kelas
 $query = "SELECT * FROM kelas";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkelas = $data['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_kelas.kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM siswa WHERE id_kelas = '$idkelas'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('siswa').innerHTML = \"<select name='ketua'><option value='0' selected>--Pilih--</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_siswa']."'>".$data2['nama_lengkap']."</option>";
   }
   $content .= "</select>\";";
   echo $content;
   echo "}\n";
 }

 ?>
 }
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_kelas/aksi_kelas.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil kelas
  default:
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
   
      ?>
		<div class="box box-solid box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPA</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
																
								<th>NIS</th>
                                                                <th>nama Lengkap</th>
                                                                <th>Total Nilai</th>
								
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php 
                                                $sqljipa1 = mysql_query("SELECT jumlah from jurusan where id_jurusan = '1'"); 
                                                $juripa1=mysql_fetch_array($sqljipa1);
                                                $ipa1 = $juripa1['jumlah'];
                                                      $tampil = mysql_query("SELECT ranking.nis, ranking.nama_lengkap, ranking.total_nilai, total_nilai 
                                                                FROM ranking JOIN siswa ON siswa.nis = ranking.nis
                                                                    ORDER BY total_nilai DESC
                                                                        LIMIT 0,$ipa1");
							   $no=1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[nis]</td>
                                                                         <td>$r[nama_lengkap]</td>
                                                                         <td>$r[total_nilai]</td>
                                                                         <td>Kelas XI IPA 1</td>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
                    
			</div>

<div class="box box-solid box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Penjurusan Bahasa</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
																
								<th>NIS</th>
                                                                <th>nama Lengkap</th>
                                                                <th>Total Nilai</th>
								
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php 
                                                $sqljbahasa = mysql_query("SELECT jumlah from jurusan where id_jurusan = '2'"); 
                                                $jurbahasa=mysql_fetch_array($sqljbahasa);
                                                $bahasa = $jurbahasa['jumlah'];
                                                $t11 = $ipa1;
                                                      $tampil = mysql_query("SELECT ranking.nis, ranking.nama_lengkap, ranking.total_nilai, total_nilai 
                                                                FROM ranking JOIN siswa ON siswa.nis = ranking.nis
                                                                    ORDER BY total_nilai DESC
                                                                        LIMIT $t11,$bahasa");
							   $no=1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[nis]</td>
                                                                         <td>$r[nama_lengkap]</td>
                                                                         <td>$r[total_nilai]</td>
                                                                         <td>Kelas XI Bahasa 1</td>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
                    
			</div>	
<div class="box box-solid box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPS</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
																
								<th>NIS</th>
                                                                <th>nama Lengkap</th>
                                                                <th>Total Nilai</th>
								
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php 
                                                $sqlips1 = mysql_query("SELECT jumlah from jurusan where id_jurusan = '3'"); 
                                                $jurips1=mysql_fetch_array($sqlips1);
                                                $ips1 = $jurips1['jumlah'];
                                                $t12 = $ipa1 + $bahasa;
                                                      $tampil = mysql_query("SELECT ranking.nis, ranking.nama_lengkap, ranking.total_nilai, total_nilai 
                                                                FROM ranking JOIN siswa ON siswa.nis = ranking.nis
                                                                    ORDER BY total_nilai DESC
                                                                        LIMIT $t12,$ips1");
							   $no=1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[nis]</td>
                                                                         <td>$r[nama_lengkap]</td>
                                                                         <td>$r[total_nilai]</td>
                                                                         <td>Kelas XI IPS 1</td>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
                    
			</div>

	<?php
      
    }
  break;
    
     
}
}
?>
