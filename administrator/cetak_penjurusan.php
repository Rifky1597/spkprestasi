<?php
include '../configurasi/koneksi.php';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <script>
        function cetak()
        {
            window.print()
            $pdf = new FPDF('L', 'mm', array(215, 330));
        }
    </script>
    <head>
        
 <!-- <link href="bootstrap.min.css" rel="stylesheet" media="screen"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="#" type="image/x-icon">
            <style type="text/css">
                body,td,th {
                    font-size: 9px;
                }
            </style>
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <title>LAPORAN</title>

    </head>

    <body>
       <button onclick="cetak()" class="btn pull-right">Cetak</button>
        <div style=" width:330mm; margin: 0px auto;">
            <div style="width:330mm; height:auto; margin:0px auto;">
                <table width="0" border="0" align="center" cellpadding="5" cellspacing="5">
                    <tr>
                        <td align="center" valign="middle"><h3><strong>LAPORAN PENJURUSAN KELAS XI <br />
                        SMAN 1 PALANGKARAYA </strong></h3></td>
                    </tr>
                </table>
            </div>



<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPA 1</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
 <table width="100%" border="2">
 
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

<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPA 2</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					 <table width="100%" border="2">
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
                                                $sqljipa2 = mysql_query("SELECT jumlah from jurusan where id_jurusan = '4'"); 
                                                $juripa2=mysql_fetch_array($sqljipa2);
                                                $ipa2 = $juripa2['jumlah'];
                                                      $tampil = mysql_query("SELECT ranking.nis, ranking.nama_lengkap, ranking.total_nilai, total_nilai 
                                                                FROM ranking JOIN siswa ON siswa.nis = ranking.nis
                                                                    ORDER BY total_nilai DESC
                                                                        LIMIT $ipa1,$ipa2");
							   $no=1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[nis]</td>
                                                                         <td>$r[nama_lengkap]</td>
                                                                         <td>$r[total_nilai]</td>
                                                                         <td>Kelas XI IPA 2</td>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
                    
			</div>
<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Penjurusan Bahasa</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table width="100%" border="2">
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
                                                $t11 = $ipa1 + $ipa2;
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
<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPS 1</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table width="100%" border="2">
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
                                                $t12 = $ipa1 + $ipa2 + $bahasa;
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
<div class="box box-body box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kelas IPS 2</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">

					<table width="100%" border="2">
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
                                                $sqlips2 = mysql_query("SELECT jumlah from jurusan where id_jurusan = '5'"); 
                                                $jurips2=mysql_fetch_array($sqlips2);
                                                $ips2 = $jurips2['jumlah'];
                                                $t13 = $ipa1 + $ipa2 + $bahasa + $ips1;
                                                      $tampil = mysql_query("SELECT ranking.nis, ranking.nama_lengkap, ranking.total_nilai, total_nilai 
                                                                FROM ranking JOIN siswa ON siswa.nis = ranking.nis
                                                                    ORDER BY total_nilai DESC
                                                                        LIMIT $t13,$ips2");
							   $no=1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[nis]</td>
                                                                         <td>$r[nama_lengkap]</td>
                                                                         <td>$r[total_nilai]</td>
                                                                         <td>Kelas XI IPS 2</td>";
							  $no++;
								}
						echo "</tbody></table>";
                                                echo "<a href='cetak_penjurusan.php' class='btn btn-primary'>Cetak</a>";
					?>
				</div>
                    
			</div>










                        <br />
                        <center></center><br />
                        <div style="height:30px; width:auto; clear:both; text-align:center;">

                            SMAN 1 Palangkaraya<br />
                            Copyright &copy;  2017</div>
                        </body>
                        </html>

