<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

include "../../../configurasi/class_paging.php";

$aksi="modul/mod_siswa/aksi_siswa.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil Siswa
  default:
    if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='pendidikan'){

  
      $tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_siswa ");
     
	  ?>

			
			<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Peserta Didik</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<a  class ='btn  btn-success btn-flat' href='?module=siswa&act=tambahsiswa'>Add Data </a>
					<a  class ='btn  btn-warning btn-flat' href='export.php'>Export Data Siswa </a>
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
								while ($r=mysql_fetch_array($tampil_siswa)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nis]</td>
											<td>$r[nama_lengkap]</td>
                                                                                        <td>$r[id_kelas]</td>
                                                                                        <td><p align='center'>$r[jenis_kelamin]</p></td>             
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
    
    }
    break;

case "lihatmurid":
    if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='pendidikan'){
    $p      = new paging_lihatmurid;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
	?>
		<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Daftar  Peserta Didik</h3>
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
								while ($r=mysql_fetch_array($tampil)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nis]</td>
											<td>$r[nama_lengkap]</td>
                                                                                        <td>$r[id_kelas]</td>
                                                                                        <td><p align='center'>$r[jenis_kelamin]</p></td>             
											 <td><p align='center'>$r[blokir]</p></td>
											 <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> 
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
    }
	}
    break;

case "tambahsiswa":
    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='pendidikan'){
        $tampil = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
		if($_GET['message'] =='success'){
			$pesan = "
				<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Data Berhasil Disimpan !!
                </div>
			
			
			";
		}
        echo "
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Peserta Didik</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=siswa&act=input_siswa' enctype='multipart/form-data' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>NIS <span style='color:red;'>*</span></label>        		
									 <div class='col-sm-4'>
										"; ?>
										<input type="number" name="nis" class="form-control" Placeholder="NIS" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
									 <?php echo "
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Lengkap <span style='color:red;'>*</span></label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama_lengkap' class='form-control' Placeholder='Nama Lengkap' required='required'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Kelas </label>        		
									 <div class='col-sm-2'>
										<select name='id_kelas' class='form-control' >
											 <option value=0 selected>--Pilih Kelas--</option>";
											 $tampil=mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
											 while($r=mysql_fetch_array($tampil)){
											 echo "<option value=$r[id_kelas]>$r[id_kelas]</option>";
											 }
										echo "</select>
									 </div>
							  </div>
							 
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Alamat <span style='color:red;'>*</span></label>        		
									 <div class='col-sm-9'>
										<input type=text name='alamat' class='form-control' Placeholder='Alamat' required='required'>
									 </div>
							  </div>
							 
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Tempat Lahir</label>        		
									 <div class='col-sm-4'>
										<input type=text name='tempat_lahir' class='form-control' Placeholder='Tempat Lahir' >
									 </div>
							  </div>
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Tanggal Lahir</label>        		
									 <div class='col-sm-1'>";
										combotgl(1,31,'tgl',$tgl_skrg);
								echo"</div>
									<div class='col-sm-3'>";
										 combonamabln(1,12,'bln',$bln_sekarang);
								echo"</div>
									<div class='col-sm-2'>";
										 combothn(1950,$thn_sekarang,'thn',$thn_sekarang);
								echo"</div>
							  </div>
							    <div class='form-group'>
									<label class='col-sm-2 control-label'>Jenis Kelamin </label>        		
									 <div class='col-sm-4'>
										
										<input type=radio name='jk' value='L'>Laki - Laki</input>
										<input type=radio name='jk' value='P'>Perempuan</input>
										
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Agama</label>        		
									 <div class='col-sm-4'>
											<select name=agama class='form-control'>
											   <option value='0' selected>--Pilih Agama--</option>
											   <option value='Islam'>Islam</option>
											   <option value='Kristen'>Kristen</option>
											   <option value='Katolik'>Katolik</option>
											   <option value='Hindu'>Hindu</option>
											   <option value='Buddha'>Buddha</option>
											</select>
									 </div>
							  </div>
							 
								
								<div class='form-group'>
									<label class='col-sm-2 control-label'>Tahun Masuk <span style='color:red;'>*</span></label>        		
									 <div class='col-sm-2'>
										"; ?>
										<input type="number" name="th_masuk" class="form-control" Placeholder="Tahun masuk siswa" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
									 <?php echo "
									 </div>
							   </div>
							  
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Blokir</label>        		
									 <div class='col-sm-4'>
										<input type=radio name='blokir' value='Y'> Y
										<input type=radio name='blokir' value='N' checked> N
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

  case "nis_ada":
     if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='pendidikan'){
         echo "<span class='judulhead'><p class='garisbawah'>nis SUDAH PERNAH DIGUNAKAN<br>
               <input type=button value=Back onclick=self.history.back()></p></span>";
     }
     break;

  case "editsiswa":
    $edit=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    
	
	$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
    $kelas = mysql_fetch_array($get_kelas);

    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='pendidikan'){
			
		echo "
		  <div class='box box-body box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Peserta Didik</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST method=POST action=$aksi?module=siswa&act=update_siswa  enctype='multipart/form-data' class='form-horizontal'>
							  <input type=hidden name=id value='$r[id_siswa]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>nis</label>        		
									 <div class='col-sm-4'>
										";?>
                                                                         <input type="number" name="nis" class="form-control" Placeholder="No HP" autocomplete="off" value="<?php echo $r[nis] ?>" onKeyPress="return goodchars(event,'0123456789',this)" required>
										
									 <?php echo "
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Lengkap</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama' class='form-control'  value='$r[nama_lengkap]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Kelas</label>        		
									 <div class='col-sm-2'>
										<select name='id_kelas' class='form-control' >
											 <option  value=$kelas[id_kelas] selected>$kelas[id_kelas]</option>";
											 $tampil=mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
											 while($k=mysql_fetch_array($tampil)){
											 echo "<option value=$k[id_kelas]>$k[id_kelas]</option>";
											 }
										echo "</select>
									 </div>
							  </div>
							 
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Alamat</label>        		
									 <div class='col-sm-9'>
										<input type=text name='alamat' class='form-control' Placeholder='Nama Lengkap' value='$r[alamat]'>
									 </div>
							  </div>
							 
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Tempat Lahir</label>        		
									 <div class='col-sm-4'>
										<input type=text name='tempat_lahir' class='form-control' Placeholder='Tempat Lahir' value='$r[tempat_lahir]' >
									 </div>
							  </div>
							 
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Tanggal Lahir</label>        		
									 <div class='col-sm-1'>";
										
										$get_tgl=substr("$r[tgl_lahir]",8,2);
										combotgl(1,31,'tgl',$get_tgl);
								
								echo"</div>
									<div class='col-sm-3'>";
										 $get_bln=substr("$r[tgl_lahir]",5,2);
										 combonamabln(1,12,'bln',$get_bln);
								
								echo"</div>
									<div class='col-sm-2'>";
										
										$get_thn=substr("$r[tgl_lahir]",0,4);
										 combothn(1950,$thn_sekarang,'thn',$get_thn);
								echo"</div>
							  </div>
							    
								<div class='form-group'>
									<label class='col-sm-2 control-label'>Jenis Kelamin</label>        		
									 <div class='col-sm-4'>
										
										<input type=radio name='jk' value='L'>Laki - Laki</input>
										<input type=radio name='jk' value='P'>Perempuan</input>
										
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Agama</label>        		
									 <div class='col-sm-4'>
											<select name=agama class='form-control' >
											   <option selected value='$r[agama]'>$r[agama]</option>
											   <option value='Islam'>Islam</option>
											   <option value='Kristen'>Kristen</option>
											   <option value='Katolik'>Katolik</option>
											   <option value='Hindu'>Hindu</option>
											   <option value='Buddha'>Buddha</option>
											</select>
									 </div>
							  </div>
							 
								
								<div class='form-group'>
									<label class='col-sm-2 control-label'>Tahun Masuk</label>        		
									 <div class='col-sm-2'>
										";?>
                                                                         <input type="number" name="th_masuk" class="form-control" Placeholder="No HP" autocomplete="off" value="<?php echo $r[th_masuk] ?>" onKeyPress="return goodchars(event,'0123456789',this)" required>
										
									 <?php echo "
									 </div>
							   </div>
							  
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Blokir</label>        		
									 <div class='col-sm-4'>
										<input type=radio name='blokir' value='Y'> Y
										<input type=radio name='blokir' value='N' checked> N
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

    
 case "detailsiswa":
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
					<h3 class='box-title'>Detail Peserta Didik</h3>
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
								  <b>Kelas</b> <a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas] class='pull-right'>$siswa[id_kelas]</a>
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
								<li class='active'><a href='#activity' data-toggle='tab'>Profil Lengkap</a></li>
								
							</ul>	
								
								<div class='tab-content'>
									<div class='active tab-pane' id='activity'>
										<div class='post'>
											
											
											<p><label class='col-sm-2 control-label'>Nama</label> $siswa[nama_lengkap] </p>     		
											<p><label class='col-sm-2 control-label'>Alamat</label> $siswa[alamat]<br> </p>   		
											<p><label class='col-sm-2 control-label'>Tempat Lahir</label>  $siswa[tempat_lahir]<br></p>      
											<p><label class='col-sm-2 control-label'>Tanggal Lahir</label> $siswa[tgl_lahir]<br><p>  ";  		
											
											
                                                                                            if ($siswa[jenis_kelamin]=='P'){
									     echo "<p><label class='col-sm-2 control-label'>Jenis Kelamin</label> Perempuan<br><p>    ";
												}
										 else{
										 echo "<p><label class='col-sm-2 control-label'>Jenis Kelamin</label> Laki - Laki<br><p>  ";
										 }echo"
											
														
											<p><label class='col-sm-2 control-label'>Agama</label> $siswa[agama]<br></p>     		
											<p><label class='col-sm-2 control-label'>Tahun Masuk</label> $siswa[th_masuk]<br> </p>   		
											
											<p><label class='col-sm-2 control-label'>Blokir</label> $siswa[blokir] <br></p>    
										</div>	
								
								    </div>
									
						</div>
					</div>
				
				</div>
			</div>";
	  
	  
    }
    break;

case "detailprofilsiswa":
    if ($_SESSION[leveluser]=='siswa'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

      echo"<br><b class='judul'>Detail Siswa</b><br><p class='garisbawah'></p>
       <table>
             <tr><td rowspan='14'>";if ($siswa[foto]!=''){
              echo "<img src='foto_siswa/medium_$siswa[foto]'>";
          }echo "</td><td>nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>
          <tr><td>Kelas</td>              <td> : $kelas[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($siswa[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td> <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td> <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>";
          echo"<tr><td colspan='3'><input type=button class='tombol' value='Edit Profil' onclick=\"window.location.href='?module=siswa&act=editsiswa&id=$siswa[id_siswa]';\"></td></tr></table>";
    }
    break;

}
}
?>
