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
       <button onclick="cetak()" class="btn pull-right">Print</button>
        <div style=" width:330mm; margin: 0px auto;">
            <div style="width:330mm; height:auto; margin:0px auto;">
                <table width="0" border="0" align="center" cellpadding="5" cellspacing="5">
                    <tr>
                        <td align="center" valign="middle"><h3><strong>DAFTAR NILAI <br />
                        SMA MUHAMMADIYAH KECAMATAN KATINGAN TENGAH </strong></h3></td>
                    </tr>
                </table>
            </div>
            <table width="100%" border="0">
                <tr>
                    <td colspan="5"><strong></strong></td>
                    <br />
                </tr>
                <tr>
                    <td width="19" rowspan="20"><table width="100%" border="1" align="center">
                            <tr>
                                <th width="1%" align="center" valign="middle">No</th>
                                <th width="4%" align="center" valign="middle">NIS</th>
                                <th width="4%" align="center" valign="middle">NAMA</th>
                                <th width="5%" align="center" valign="middle">NILAI SAW</th>
                                <th width="5%" align="center" valign="middle">NILAI WP</th>
                            </tr>
                            <tbody>
                            <?php
                            $no = 1;
                            $data = mysql_query("select * from ranking order by nilai_wp DESC");
                            while ($dates = mysql_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no;
                                    $no++; ?></td> 
                                    
                                        <td align="center" valign="middle"><?php echo $dates['nis']; ?></td>
                                        <td align="left" valign="middle"><?php echo $dates['nama_lengkap']; ?></td>
                                        <td align="center" valign="middle"><?php echo $dates['nilai_saw']; ?></td>
                                        <td align="center" valign="middle"><?php echo $dates['nilai_wp']; ?></td>
                                        </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>

                        </table>
                        <br />
                        <center></center><br />
                        <div style="height:30px; width:auto; clear:both; text-align:center;">

                            SMA Negeri 2 Sampit<br />
                            Copyright &copy;  2023</div>
                        </body>
                        </html>

