
<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    if ($_SESSION[leveluser]=='admin'){
	?>
		  <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
				
					<div class="row mt">
				<form action="" method="POST">
						<div class="col-lg-8 col-lg-offset-2">
							<form role="form">
						<div class="form-group">
							<select class="form-control" id="exampleInputEmail1" name="pilih">
							<option value = ""> -- Pilih Kelas -- </option>
							<?php 
                                                        $sqls = mysql_query("select * from kelas"); 
                                                        while($rows = mysql_fetch_array($sqls)){
                                                        ?>
                                                        <option value="<?php echo $rows['nama']; ?>"><?php echo $rows['nama']; ?></option>
                                                        <?php } ?>
							</select>
				  </div>
				  <input type="submit" name="submit" class="btn btn-primary" value="Pilih">
				</form>    			
			</div>
			</form>
		</div><!-- /row -->
	
						
						
					</div>
				</div>
			</div>
</div>



<?php
	if(isset($_POST['submit'])){
		?>
		  <div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Nilai</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					<table  class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
                                <th>Kelas</th>
								<th>Nilai SAW</th>
								<th>Nilai WP</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 

							$nama=$_POST['pilih'];
							
							$tampil=mysql_query("SELECT siswa.id_siswa, ranking.nis, ranking.nama_lengkap, ranking.nilai_wp, ranking.nilai_saw, siswa.id_kelas, nilai_wp, kelas.nama
                                                                                FROM ranking 
                                                                                JOIN siswa ON siswa.nis = ranking.nis
                                                                                JOIN kelas ON kelas.id_kelas = siswa.id_kelas
                                                                                WHERE kelas.nama = '$nama' ORDER BY nilai_wp DESC");
                                                        $no=1;
							while ($r=mysql_fetch_array($tampil)){
								  echo "<tr><td>$no</td>
										<td>$r[nis]</td>
										<td>$r[nama_lengkap]</td>
										<td>$r[nama]</td>
                                        <td>$r[nilai_saw]</td>
                                        <td>$r[nilai_wp]</td>
										<td width=200>
                                        <a href=?module=nilai&act=lihatnilai&id=$r[id_siswa] title='Lihat' class='btn btn-success btn-xs'>Lihat Nilai</a>
										</td></tr>";



                                                                                         $no++;
                                                                                         }
                                                                                         
						echo "</tbody></table>";
                                                // echo "<a href='cetak_nilai.php' class='btn btn-primary'>Cetak</a>";
                                                
					?>
				</div>
			</div>	
	<?php
	}
?>
	<?php
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

  case "lihatnilai":
    if ($_SESSION[leveluser]=='admin'){
        $siswa2 = mysql_query("SELECT * FROM siswa WHERE id_siswa ='$_GET[id]'");
        while ($siswa=mysql_fetch_array($siswa2)){
		echo "
		  <div class='box box-primary box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Modul</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						 <h1>DATA NILAI SISWA $siswa[nama_lengkap]</h1>
                                                     "; 
        }
                echo"
  </div>
  <div class='block-content'>	
   <table id='table-example' class='table'>	  
	         
   <thead><tr>
   <th>No</th>
   <th>Kriteria</th>
   <th>Nilai</th>
   
  </thead>
   <tbody>";
    $tampil_siswa = mysql_query("SELECT * FROM v_analisa WHERE id_siswa ='$_GET[id]'");
    $no=1;
      while ($r=mysql_fetch_array($tampil_siswa)){		  

	  
   echo "<tr class=gradeX>
   <td width=50><center>$no</center></td>";
   echo "<td>$r[kriteria]</td>
         <td>$r[nama]</td>"
           . "</tr>";

				
				
    $no++;
    }
    echo "</table>
							  
				</div> 
				
			</div>";
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
       echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;
 
}
}
?>
