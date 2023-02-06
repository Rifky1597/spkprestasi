
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
							<option value = ""> -- Pilih Tahun -- </option>
							<option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2020">2021</option>
                                                        <option value="2020">2022</option>
                                                        <option value="2020">2023</option>
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
					<?php $nama=$_POST['pilih']; ?>
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>								
								<th>Ranking Tahun <?php echo $nama; ?></th>
                                                                <th>Nilai Vektor V</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							
							$tampil=mysql_query("SELECT * FROM rankingtahun JOIN siswa ON siswa.nis = rankingtahun.nis
                                                                                    where tahun='$nama' ORDER BY vektor_v DESC");
                                                        $no=1;
							while ($r=mysql_fetch_array($tampil)){
								  echo "<tr><td>$no</td>
										<td>$r[nis]</td>
										<td>$r[nama_lengkap]</td>
										<td>Peringkat $no</td>
                                                   	<td>$r[vektor_v]</td>                       
										<td width=200>
   
                                                                                        <a href=?module=nilai&act=lihatnilai&id=$r[id_siswa] title='Cek' class='btn btn-success btn-xs'>Cek Score</a>

                                                                                        </td></tr>";



                                                                                         $no++;
                                                                                         }
                                                                                         
						echo "</tbody></table>";
                                                echo "<a href='cetak_nilai.php' class='btn btn-primary'>Print</a>";
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
					<h3 class='box-title'>ADD Data Modul</h3>
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
