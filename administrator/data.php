<table border="1">
 <tr>
 <th>NO.</th>
 <th>NIS</th>
 <th>NAMA LENGKAP</th>
 <th>KELAS</th>
 <th>ALAMAT</th>
 <th>TEMPAT LAHIR</th>
 <th>TANGGAL LAHIR</th>
 <th>JENIS KELAMIN</th>
 <th>AGAMA</th>
 <th>TAHUN MASUK</th>
 </tr>
 <?php
 //koneksi ke database
 mysql_connect("localhost", "root", "");
 mysql_select_db("spkprestasi");
 
 //query menampilkan data
 $sql = mysql_query("SELECT * FROM siswa");
 $no = 1;
 while($data = mysql_fetch_assoc($sql)){
 echo '
 <tr>
 <td>'.$no.'</td>
 <td>'.$data['nis'].'</td>
 <td>'.$data['nama_lengkap'].'</td>
 <td>'.$data['id_kelas'].'</td>
 <td>'.$data['alamat'].'</td>
 <td>'.$data['tempat_lahir'].'</td>
 <td>'.$data['tgl_lahir'].'</td>
 <td>'.$data['jenis_kelamin'].'</td>
 <td>'.$data['agama'].'</td>
 <td>'.$data['th_masuk'].'</td>
 </tr>
 ';
 $no++;
 }
 ?>
</table>