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
$aksi="modul/mod_analisa/aksi_analisa.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    if ($_SESSION[leveluser]=='admin'){
	
	 $tampil_siswa = mysql_query("SELECT * FROM siswa");	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	 $tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
     
	 //Matrik Awal
	 ?>
	 
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">DATA KRITERIA</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>nis</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>K$a</th>";
							
							$a++;
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[nis]</td>
								<td>$h[nama_lengkap]</td>";
								
								$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_siswa = '$r[id_siswa]'");
								while ($n=mysql_fetch_array($klasifikasi)){
									
										$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
										
										echo "<td>$himpunankriteria[nama]</td>";
										
									
								}
								
								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
			
			<?php
			// BOBOT
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">BOBOT</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					
					
                                    <table id="example2" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>nis</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>K$a</th>";
							
							$a++;
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[nis]</td>
								<td>$h[nama_lengkap]</td>";
								
								$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_siswa = '$r[id_siswa]'");
								while ($n=mysql_fetch_array($klasifikasi)){
									
										$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
										
										echo "<td>$himpunankriteria[nilai]</td>";
										
									
								}
								
								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
			
			
			
			
			


			<?php

			//NORMALISASI
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
				<h3 class="box-title">NORMALISASI W</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
                                    <table id="example3" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>nis</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>K$a</th>";
							
							$a++;
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[nis]</td>
								<td>$h[nama_lengkap]</td>";
								
								
								$klasifikasi = mysql_query("SELECT * FROM v_analisa WHERE id_siswa = '$r[id_siswa]'");
								while ($n=mysql_fetch_array($klasifikasi)){
									$crmax = mysql_fetch_array(mysql_query("SELECT * FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
									$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
									
									//$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'] / 100;
									$nilaiok = (pow($himpunankriteria['nilai'],($crmax['bobot']) / 100));	
										echo "<td>$nilaiok</td>";
									
									
								}
								
								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
                                                    </div>
                             </div>
	
			
			<?php
		
			//vektor S
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa");
                              
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Vektor S</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
                                   
			<?php echo "<form method=POST action='$aksi?module=analisa&act=input'>";	?>	
                                    <table class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Vektor S</th>
						
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$i=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));
                                                                    $nis = $h[nis];
                                                                    $nama = $h[nama_lengkap];
								
								echo "
								<td>$i</td>
								<td>$nis</td>
								<td>$nama</td>";
                                                                
								
								$klasifikasi = mysql_query("SELECT * FROM v_analisa WHERE id_siswa = '$r[id_siswa]'");
                                                                $totalnilai = 1;
								while ($n=mysql_fetch_array($klasifikasi)){

									$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
									$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
									$bobot = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$n[id_kriteria]'"));
									$nilaiok = $himpunankriteria['nilai'];
									$rank2 = $bobot['bobot'] / 100;
                                    $rank = pow($nilaiok,$rank2);
                                    $totalnilai = $totalnilai * $rank;
                           			}
                           			$arr_nis[]=$nis;
                           			$arr_nama[]=$nama;
                             		$veks[]=$totalnilai;     
                                    echo "<td>$totalnilai</td>";
                                    
                                    echo "</tr>";
                                    $i++;
                                    }	

						echo "</tbody></table>";
                        $jumsiswa = mysql_num_rows(mysql_query("SELECT * FROM v_analisa GROUP BY id_siswa"));
					   echo "
					   </form>";	
					?>
                                                    
				</div>
			</div>	
<?php
		
			//vektor V
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa");
            $tampil_ranking = mysql_query("SELECT * FROM ranking");
                              
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Vektor V</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">                                   
                    <table class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
                                <th>Vektor V</th>
						
								
							</tr>
						</thead>
						<tbody>
						
					<?php 
							$j=1;
							$tahun = date('Y');
							for ($i=0; $i < count($arr_nis) ; $i++) { 
							$nis = $arr_nis[$i];
							$nama = $arr_nama[$i];

							echo "		
								<td>".$j++."</td>
								<td>$arr_nis[$i]</td>
								<td>$arr_nama[$i]</td>";
									
									$totalvektor = array_sum($veks);
                                    $totalnilai2 = $veks[$i] / $totalvektor;
                            
                                                                        
                                    echo "<td>$totalnilai2</td>";
                                    echo "</tr>";

							$cek = mysql_num_rows(mysql_query("SELECT * FROM ranking where nis='$nis'"));
                            if($cek>0){
                           	mysql_query("UPDATE ranking SET nilai_wp = '$totalnilai2' where nis='$nis'");
                            }  else{
                          mysql_query("INSERT INTO ranking(nis,nama_lengkap,nilai_wp,tahun) VALUES('$nis','$nama','$totalnilai2','$tahun')");
                            }     



                              }	

						echo "</tbody></table>";
					?>
                                                    
				</div>
			</div>	
	 <?php
		 
    }
}
}

    ?>