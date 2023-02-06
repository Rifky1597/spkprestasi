
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_manajemen_penjurusan/aksi_manajemen_penjurusan.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_jurusan = mysql_query("SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
	  ?>
	   <div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">MANAJEMEN PENJURUSAN</h3>
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
								<th>Nama Jurusan</th>
								<th>Jumlah</th>
                                                                <th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							while ($r=mysql_fetch_array($tampil_jurusan)){
							   echo "<tr><td>$no</td>
									 <td>$r[nama_jurusan]</td>
									 <td>$r[jumlah]</td>  
									 <td><a href='?module=manajemen_penjurusan&act=editjurusan&id=$r[id_jurusan]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a></td></tr>";
							  $no++;
							}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
		
	  
	  <?php
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break; 
    
  case "editjurusan":
    $edit=mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "
		  <div class='box box-primary box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Jurusan</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=manajemen_penjurusan&act=update_manajemen_penjurusan' class='form-horizontal'>
							  <input type=hidden name='id_jurusan' value='$r[id_jurusan]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Jurusan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nama_jurusan' class='form-control' value='$r[nama_jurusan]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Jumlah Siswa</label>        		
                                                                         <div class='col-sm-4'>"; ?>
										<input type="number" name="jumlah" class="form-control" value="<?php echo $r[jumlah]; ?>" onKeyPress="return goodchars(event,'0123456789',this)">
									 <?php echo "</div>
							  </div>
							  
							
							  
							  
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Simpan>
							  <input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;
}
}
?>
