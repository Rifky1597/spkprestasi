<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

include "../../../configurasi/class_paging.php";
include "../../../configurasi/excel_reader.php";

    if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='pendidikan'){

  
     
     
	  ?>
			
			
			<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Peserta Didik Import 2</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<div class="row">
                                            
                                <div class="col-lg-6">
                                   
                                    <form class="form-horizontal" name="myForm" id="myForm" onSubmit="return validateForm()" action="?module=import" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<div class="col-md-10">
											<strong>Keterangan :</strong> Format excel *.xls (save MS.Excel 2003 )
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-10">
											<strong>File Excel :</strong> <input type="file" id="import_file" name="import_file" /> 
											
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" name="submit" class="btn btn-success" value="Import File (.xls)"/>
									</div>

									</form>
                                    
                                    <a href="../template/excel.xlsx" class="btn btn-success">Download Template</a> <p>
                                        
                                    </p>
                                 <button class="btn btn-success" onclick="window.location.href = window.location.href;">&nbsp;Refresh</button>
                                </div>
                                            
                                <!-- /.col-lg-6 (nested) -->
								
								<div class="col-md-6">
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                ?>
                                                <div id="progress" style="width:500px;border:1px solid #ccc;"></div>
                                                <div id="info"></div>
                                                <?php
                                            }
                                            ?>

                                            <script type="text/javascript">
                                                //    validasi form (hanya file .xls yang diijinkan)
                                                function validateForm()
                                                {
                                                    function hasExtension(inputID, exts) {
                                                        var fileName = document.getElementById(inputID).value;
                                                        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                                                    }

                                                    if (!hasExtension('import_file', ['.xls'])) {
                                                        alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <?php
                                            mysql_connect('localhost', 'root', '');
                                            mysql_select_db('spkprestasi');
                                            include "excel_reader.php";

                                            if (isset($_POST['submit'])) {

                                                $target = basename($_FILES['import_file']['name']);
                                                move_uploaded_file($_FILES['import_file']['tmp_name'], $target);

                                                $data = new Spreadsheet_Excel_Reader($_FILES['import_file']['name'], false);

//    menghitung jumlah baris file xls
                                                $baris = $data->rowcount($sheet_index = 0);
												//echo $baris;
//    jika kosongkan data dicentang jalankan kode berikut
                                                if ($_POST['drop'] == 1) {
//             kosongkan tabel sbmptn
                                                    $truncate = "DELETE FROM siswa";
                                                    mysql_query($truncate);
                                                };

//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
                                                for ($i = 9; $i <= $baris; $i++) {
//        menghitung jumlah real data. Karena kita mulai pada baris ke-2, maka jumlah baris yang sebenarnya adalah 
//        jumlah baris data dikurangi 1. Demikian juga untuk awal dari pengulangan yaitu i juga dikurangi 1
                                                    $barisreal = $baris - 8;
                                                    $k = $i - 8;

// menghitung persentase progress
                                                    $percent = intval($k / $barisreal * 100) . "%";

// mengupdate progress
                                                    echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div style=\"width:' . $percent . '; background-color:lightblue\">&nbsp;</div>";
        document.getElementById("info").innerHTML="' . $k . ' data berhasil diimport (' . $percent . ' selesai). Silahkan Klik Menu Refresh";
        </script>';

//       membaca data (kolom ke-1 sd terakhir)
						    $nis = addslashes($data->val($i, 2));
                            $nama = addslashes($data->val($i, 3));
                            $kelas = addslashes($data->val($i, 4));
                            $alamat = addslashes($data->val($i, 5));
                            $tempat_lahir = addslashes($data->val($i, 6));      
                            $tgl_lahir = addslashes($data->val($i, 7));
                            $jenis_kelamin = addslashes($data->val($i, 8));
                            $agama = addslashes($data->val($i, 9));
                            $nama_ayah = addslashes($data->val($i, 10));
                            $nama_ibu = addslashes($data->val($i, 11));
                            $th_masuk = addslashes($data->val($i, 12));
                            $email = addslashes($data->val($i, 13));
                            $no_telp = addslashes($data->val($i, 14));
                                                            
//      setelah data dibaca
                                                   $cek = mysql_query("select nis from siswa where nis = '$nis'");
                                                    if (mysql_num_rows($cek) > 0) {
                                                        echo "<script> alert('Data Berhasil Diimport');</script>";
                                                    } else {
                                                        $que = "INSERT INTO siswa(nis,
                                                                                nama_lengkap,
                                                                                id_kelas,
                                                                                alamat,
                                                                                tempat_lahir,
                                                                                tgl_lahir,
                                                                                jenis_kelamin,
                                                                                agama,
                                                                                nama_ayah,
                                                                                nama_ibu,
                                                                                th_masuk,
                                                                                email,
                                                                                no_telp,
                                                                                foto,
                                                                                blokir)
                                                                              VALUES('$nis',
                                                                               '$nama',
                                                                               '$kelas',
                                                                               '$alamat',
                                                                               '$tempat_lahir',
                                                                               '$tgl_lahir',
                                                                               '$jenis_kelamin',
                                                                               '$agama',
                                                                               '$nama_ayah',
                                                                               '$nama_ibu',
                                                                               '$th_masuk',
                                                                               '$email',
                                                                               '$no_telp',
                                                                               'favicon.png',
                                                                               'N')";
							$hasil = mysql_query($que);
                                                   }
                                                    

//      kita tambahkan sleep agar ada penundaan, sehingga progress terbaca bila file yg diimport sedikit
//      pada prakteknya sleep dihapus aja karena bikin lama hehe
                                                }

//    hapus file xls yang udah dibaca
                                                unlink($_FILES['import_file']['name']);
                                            }

                                            $time = microtime();
                                            $time = explode(' ', $time);
                                            $time = $time[1] + $time[0];
                                            $finish = $time;
                                            $total_time = round(($finish - $start), 4);
                                            ?>  


                                        </div>
								
                            </div>
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
								 $tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas ");
								while ($r=mysql_fetch_array($tampil_siswa)){
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
											 <a href=javascript:confirmdelete('$aksi?module=siswa&act=hapus&id=$r[id_siswa]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
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
?>
