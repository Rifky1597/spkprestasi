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
      $tampil = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
	?>
		<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<a  class ='btn  btn-success btn-flat' href='?module=kelas&act=tambahkelas'>Add Data </a>
					<br><br><br>
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>Id Kelas</th>
								<th>Kelas</th>
								
								<th>Jml Siswa</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							   $no =1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[id_kelas]</td>
									 <td>$r[nama]</td>
									 ";
									  $jmlmhs= mysql_fetch_array(mysql_query("SELECT count(nis) as jmlmhs FROM siswa WHERE id_kelas = '$r[id_kelas]'"));
									  echo "<td>$jmlmhs[jmlmhs]</td>";
									
									 echo "<td><a href='?module=kelas&act=editkelas&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> |
										 <a href=javascript:confirmdelete('$aksi?module=kelas&act=hapuskelas&id=$r[id]') title='Delete' class='btn btn-danger btn-xs'>Delete</a> 
										 <a href=?module=kelas&act=detailkelas&id=$r[id_kelas] class='btn btn-success btn-xs'>Cek Siswa</a></td></tr>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
	<?php
      
    }
    break;
    
    case "tambahkelas":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
		echo "
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Kelas</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=kelas&act=input_kelas' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID Kelas</label>        		
									 <div class='col-sm-4'>
										<input type=text name='id_kelas' class='form-control' Placeholder='ID Kelas' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Kelas</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama' class='form-control' Placeholder='Nama Kelas' required='required'>
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

    case "editkelas":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
    $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $niss = mysql_fetch_array($getnis);
	$getjur = mysql_query("SELECT * FROM jurusan WHERE kodejurusan = '$r[kodejurusan]'");
    $jurr = mysql_fetch_array($getjur);
    
   echo "
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Kelas</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=kelas&act=update_kelas' class='form-horizontal'>
							<input type=hidden name=id value='$r[id]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID Kelas</label>        		
									 <div class='col-sm-4'>
										<input type=text name='id_kelas' class='form-control' Placeholder='ID Kelas' value='$r[id_kelas]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Kelas</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama' class='form-control' Placeholder='Nama Kelas' value='$r[nama]'>
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


case "detailkelas":
    $detail=mysql_query("SELECT * FROM siswa WHERE id_kelas='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='pendidikan'){
		?>
	 <div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Detail Kelas</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					<br><br><br>
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Jenis Kelamin</th>
								<th>Blokir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
								$no=1;
								while ($r=mysql_fetch_array($detail)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nis]</td>
											<td>$r[nama_lengkap]</td>";
												$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
												while($k=mysql_fetch_array($kelas)){
														echo"<td>$k[nama]</td>";
												}
										echo"<td><p align='center'>$r[jenis_kelamin]</p></td>             
											 <td><p align='center'>$r[blokir]</p></td>
											 <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit' class='btn btn-warning btn-xs'>Edit</a> 
											 <a href=javascript:confirmdelete('$aksi?module=siswa&act=hapus&id=$r[id_siswa]') title='Delete' class='btn btn-danger btn-xs'>Delete </a>
											 <a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa] class='btn btn-success btn-xs'> Detail</a>
				  
											</td>
										</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
 
    break;

 
}
}
}
?>
