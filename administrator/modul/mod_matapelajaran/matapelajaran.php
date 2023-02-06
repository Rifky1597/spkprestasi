<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<script language="JavaScript" type="text/JavaScript">

 function showpel()
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
   echo "if (document.form_materi.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_kuliah WHERE id_kelas = '$idkelas' AND id_pengajar = '0'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran').innerHTML = \"<select name='".kodematkul."'>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['kodematkul']."'>".$data2['nama']."</option>";
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
    
    
//bagian pembobotan kriteria
$aksi="modul/mod_matapelajaran/aksi_matapelajaran.php";
switch($_GET[act]){
// Tampil kriteria
  default:
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	
     ?>
	 <div class="col-md-8">
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kriteria</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<?php echo"<a  class ='btn  btn-success btn-flat' href='?module=matapelajaran&act=tambahkriteria'>ADD </a>"; ?>
					<br><br><br>
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>Nama Kriteria</th>
								<th>Bobot</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_kriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[kriteria]</td>
								 <td>$r[bobot]</td>
							
								
								 <td><a href='?module=matapelajaran&act=editkriteria&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> |
									 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Delete'  class='btn btn-danger btn-xs'>Delete</a></td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	
	
    break;

case "tambahkriteria":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
         echo "
		  <div class='col-md-8'>
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Kriteria</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran' enctype='multipart/form-data' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nama Kriteria</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Bobot</label>        		
									 <div class='col-sm-2'>
										"; ?>
										<input type="number" name="bobot" class="form-control" Placeholder="Bobot" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
									 <?php echo "
									 </div>
							  </div>
							  			 
							  				  
							
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Save>
							  <input class='btn btn-danger' type=button value=Cancel onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
		  
    }
	
   
    break;

case "editkriteria":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
        $kriteria=mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($kriteria);
        
        
        echo "
		   <div class='col-md-8'>
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Kriteria</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_matapelajaran'  class='form-horizontal'>
							  <input type=hidden name=id value='$m[id]'>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nama Kriteria</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' value='$m[kriteria]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Bobot</label>        		
									 <div class='col-sm-3'>
										"; ?>
										<input type="number" name="bobot" class="form-control" Placeholder="bobot" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $m[bobot]; ?>">
									 
         <?php echo "</div>
							  </div>
							  
							  
							  
							  
							
							  
							  
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Save>
							  <input class='btn btn-danger' type=button value=Cancel onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
		
    }
    break;
case "detailpelajaran":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
        $detail =mysql_query("SELECT * FROM mata_kuliah WHERE kodematkul = '$_GET[id]'");
        echo "<div class='information msg'>Detail Mata Kuliah</div>
          <br><table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Id Mapel</th><th>Nama</th><th>Kelas</th><th>Pengajar</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
        $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>
             <td>$r[kodematkul]</td>
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> |
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Delete'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>
    <div class='buttons'>
    <br><input class='button blue' type=button value=Kembali onclick=self.history.back()>
    </div>";
    }else{
      $detail =mysql_query("SELECT * FROM mata_kuliah WHERE kodematkul = '$_GET[id]'");
        echo "<span class='judulhead'><p class='garisbawah'>Detail Mata Kuliah</p></span>
          <table>
          <tr><th>no</th><th>nama</th><th>kelas</th><th>pengajar</th><th>deskripsi</th></tr>";
                    $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td></tr>";
             
      $no++;
    }
    echo "</table>
    <input type=button value=Cancel onclick=self.history.back()>";
    }
    break;
//bagian data himpunankriteria	
	case "himpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	
     ?>
	 <div class="col-md-8">
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kriteria</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
	
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>Nama Kriteria</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_kriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[kriteria]</td>
								
							
								
								 <td><a href='?module=matapelajaran&act=listhimpunankriteria&id=$r[id]' title='input Data Kriteria' class='btn btn-primary btn-xs'>Input Data Kriteria</a> 
									</td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	break;
	
//bagian himpunan kriteria	
	case "listhimpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
	 $a = mysql_fetch_array($tampil_kriteria);
	 
	 $tampil_himpunankriteria = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$_GET[id]'");
	?>
	 <div class="col-md-8">
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Himpunan Kriteria <?php echo $a['kriteria']; ?> </h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						
					</div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					<?php echo "<a  class ='btn  btn-success btn-flat' href='?module=matapelajaran&act=tambahhimpunan&id=$a[id]'>ADD </a>"; ?>
					<br><br><br>
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>List</th>
								<th>Keterangan</th>
								<th>Nilai</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_himpunankriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[nama]</td>
								<td>$r[keterangan]</td>
								<td>$r[nilai]</td>
								
							
								
								<td><a href='?module=matapelajaran&act=edithimpunankriteria&id=$r[id_hk]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> 
									 <a href='$aksi?module=matapelajaran&act=hapus_himpunan&id=$r[id_hk]&id_kriteria=$r[id_kriteria]' title='Delete'  class='btn btn-danger btn-xs'>Delete</a></td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	break;
	
	case "tambahhimpunan":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
	 $a = mysql_fetch_array($tampil_kriteria);
		
		
	echo "
		  <div class='col-md-8'>
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Himpunan Kriteria $a[kriteria]</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=input_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>							 
							 <div class='form-group'>
									<label class='col-sm-3 control-label'>Masukan Data</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nama' class='form-control' Placeholder='Masukan Data' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Keterangan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='ket' class='form-control' Placeholder='Keterangan' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nilai</label>        		
									 <div class='col-sm-2'>
										"; ?>
										<input type="number" name="nilai" class="form-control" Placeholder="Nilai" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
									 <?php echo "
									 </div>
							  </div>
							  			 
							  				  
							
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Save>
							  <input class='btn btn-danger' type=button value=Cancel onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
		  
 
	
	 
		 
    }
	
	
    break;
	
	
	case "edithimpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	$tampil_hk = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk = '$_GET[id]'");
	$f = mysql_fetch_array($tampil_hk);
	
	$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$f[id_kriteria]'");
	$a = mysql_fetch_array($tampil_kriteria);
		
		
	echo "
		  <div class='col-md-8'>
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Himpunan Kriteria $a[kriteria]</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>							 
							<input type=hidden name='id_hk' class='form-control' Placeholder='Masukan Data' value='$f[id_hk]'>							 
							 <div class='form-group'>
									<label class='col-sm-3 control-label'>Masukan Data</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nama' class='form-control' Placeholder='Masukan Data' value='$f[nama]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Keterangan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='ket' class='form-control' Placeholder='Keterangan' value='$f[keterangan]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nilai</label>        		
									 <div class='col-sm-2'>
										"; ?>
										<input type="number" name="nilai" class="form-control" Placeholder="Nilai" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $f[nilai]; ?>">
									 
         <?php echo "
									 </div>
							  </div>
							  			 
							  				  
							
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Save>
							  <input class='btn btn-danger' type=button value=Cancel onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
		  
 
	
	 
		 
    }
	
	
    break;
	
	//klasifikasi
	case "klasifikasi":
	if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='pendidikan'){

  
      $tampil_siswa = mysql_query("SELECT *
                                        FROM siswa 	
                                                 ORDER BY id_kelas");
      
	  ?>
			
<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Klasifikasi</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
                                   <form method="POST" action="modul/mod_matapelajaran/reset.php">
                                   <input class='btn btn-primary' type=submit value=Reset>
                                   </form>
					<br><br><br>
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>nis</th>
								<th>Nama</th>
								<th>Kelas</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
								$no=1;
								while ($r=mysql_fetch_array($tampil_siswa)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nis]</td>
											<td>$r[nama_lengkap]</td>";
												$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
												while($k=mysql_fetch_array($kelas)){
														echo"<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</a></td>";
												}
										echo"
											 <td><a href=?module=matapelajaran&act=editklasifikasi&id=$r[id_siswa] class='btn btn-primary btn-xs'>Edit Klasifikasi</a> 
											 ";
                                                                                $cek = mysql_query("SELECT id_siswa FROM tbl_klasifikasi WHERE id_siswa='$r[id_siswa]'");
                                                                                if (mysql_num_rows($cek)>0){
                                                                                                                    "Data Sudah terisi";
                                                                                                                } else {
                                                                                                                    "Data Belum terisi";
                                                                                                                }
				  
										echo"</td>
										</tr>";
								$no++;
								}
                                                                
						echo "</tbody></table>";
                                                
					?>
				</div>
			</div>	
             
	
		
			
					
				
		

<?php
    
    }
    break;
	
	case "editklasifikasi":
    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='pendidikan'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);
       
	   $friends = mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_kelas='$siswa[id_kelas]'"));
      echo "
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Klasifikasi</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
					<div class='col-md-3'>
						<div class='box box-danger'>
							<div class='box-body box-profile'>";
							    if ($siswa[foto]!=''){
									echo "<img class='profile-user-img img-responsive img-circle' src='../foto_siswa/medium_$siswa[foto]' alt='User profile picture'>";
								}
	
      
              
							
							  
							 echo "		 
							  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>
							  <p class='text-muted text-center'>$siswa[nis]</p>

							  <ul class='list-group list-group-unbordered'>
								<li class='list-group-item'>
								  <b>Username </b> <a class='pull-right'>$siswa[username_login]</a>
								</li>
								<li class='list-group-item'>
								  <b>Kelas</b> <a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas] class='pull-right'>$kelas[nama]</a>
								</li>
								<li class='list-group-item'>
								  <b>Jumlah Siswa</b> <a class='pull-right'>$friends</a>
								</li>
								
							  </ul>
							  <input class='btn btn-primary btn-block' type=button value=Back onclick=self.history.back()>
							  
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class='col-md-9'>	
						<div class='nav-tabs-custom'>
							<ul class='nav nav-tabs'>
								<li class='active'><a href='#activity' data-toggle='tab'>Edit Klasifikasi</a></li>
								
							</ul>	
								
								<div class='tab-content'>
									<div class='active tab-pane' id='activity'>
										<div class='post'>
										<form method=POST action='$aksi?module=matapelajaran&act=input_klasifikasi' ' class='form-horizontal'>
										<input type='hidden' value ='$siswa[id_siswa]' name='id_siswa'>
										";
											
											$kriteria = mysql_query("SELECT * FROM tbl_kriteria");
											$i=1;
											while ($f = mysql_fetch_array($kriteria)){
												
												$forms = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$f[id]'");
												
												echo "<p>
												<div class='form-group'>
													<label class='col-sm-3 control-label'>$f[kriteria]</label> 
													<div class='col-sm-2'>
													
													<select name='id_hk$i' class=' form-control  '  >
														 ";
														
														 while($r=mysql_fetch_array($forms)){
														 echo "<option value=$r[id_hk]>$r[nama]</option>";
														 
														 }
													
													echo "</select>
													
												</div>
												</div>
												</p>
												
												";     
												$i++;
											}
											
										$jumkriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria"));
										
										echo"
											<div class='buttons'>
												<input type='hidden' value='$jumkriteria' name='jumkriteria' >
												<input class='btn btn-success' type=submit value=Process>
											</div>
											</form>
											
													
											
										   		
		
										</div>	
								
								    </div>
									
						</div>
					</div>
				
				</div>
			</div>";
	  
	  
    }
	break;
	
	case "analisa":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
	
	 $tampil_siswa = mysql_query("SELECT * FROM siswa");	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	 $tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
     
	 //Matrik Awal
	 ?>
	 
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					
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
								
								echo "<th>C$a</th>";
							
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
			
			
			
			
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					
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
								
								echo "<th>C$a</th>";
							
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
			
			
			
			
			//Normalisai
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					
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
								
								echo "<th>C$a</th>";
							
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
									$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
									$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
									
									$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'];
										
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
			
			
			
			
			//Rangking
			
			$tampil_siswa = mysql_query("SELECT * FROM siswa");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
			?>
			
			 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Ranking</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					
					<table id="example4" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>nis</th>
								<th>Nama</th>
								<th>Total Nilai</th>
						
								
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
								$totalnilai = 0;
								while ($n=mysql_fetch_array($klasifikasi)){
									$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
									$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
									$bobot = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$n[id_kriteria]'"));
									$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'];
									$rank = $nilaiok * $bobot['bobot'];									
									$totalnilai = $totalnilai + $rank;	
										
									
									
								}
								echo "<td>$totalnilai</td>";
								echo"
								
								
								
								</tr>";
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
