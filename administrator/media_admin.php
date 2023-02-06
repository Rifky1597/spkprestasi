<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
    if ($_SESSION['leveluser']=='siswa'){
     echo "<link href=css/style.css rel=stylesheet type=text/css>";
     echo "<div class='error msg'>Anda tidak diperkenankan mengakses halaman ini.</div>";
    }
    else{

?>
<html>
<head>
<title>SPK || Sistem Penunjang Keputusan Dengan Metode WP</title>
		
		<!-- Bootstrap -->
         <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
		 <!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        
		 <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
		 
		 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		 
		 <!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
		
		<!-- Morris chart -->
		<link rel="stylesheet" href="plugins/morris/morris.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Date Picker -->
		<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		 <!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		
		
        
        
		
		
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		

		<!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
       
        <script src="assets/scripts.js"></script>
        	
	





<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/Delicious_500.font.js"></script>
<script type="text/javascript" src="js/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script type="text/javascript" src="../js/clock.js"></script>

<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/switcher.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/tabcontent.js"></script>



<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>

  
  <script language="javascript">
      	function getkey(e)
      	{
	      	if (window.event)
	         	return window.event.keyCode;
	      	else if (e)
	         	return e.which;
	      	else
	         	return null;
      	}

      	function goodchars(e, goods, field)
      	{
	      	var key, keychar;
	      	key = getkey(e);
	      	if (key == null) return true;
	       
	      	keychar = String.fromCharCode(key);
	      	keychar = keychar.toLowerCase();
	      	goods = goods.toLowerCase();
	       
	      	// check goodkeys
	      	if (goods.indexOf(keychar) != -1)
	          	return true;
	      	// control keys
	      	if ( key==null || key==0 || key==8 || key==9 || key==27 )
	         	return true;
	          
	      	if (key == 13) {
	          	var i;
	          	for (i = 0; i < field.form.elements.length; i++)
	              	if (field == field.form.elements[i])
	                  	break;
	          	i = (i + 1) % field.form.elements.length;
	          	field.form.elements[i].focus();
	          	return false;
	          	};
	      	// else return false
	      	return false;
    	}
    	</script>

<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

</head>

<body onload="startclock()" class="hold-transition skin-blue sidebar-mini">

<?php
if ($_SESSION[leveluser]=='admin'){
?>
	<div class="wrapper">
		<header class="main-header">
			 <!-- Logo -->
			<a href="?module=home" class="logo">
				
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>SP</b>K</span>
				
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>SPK</b></span>
			</a>
			 
			 <!-- Header Navbar: style can be found in header.less -->
			 <nav class="navbar navbar-static-top" role="navigation">
					
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
                                                    <a href="?module=admin">
								<img src="dist/img/user.png" class="user-image" alt="User Image">
								<span class="hidden-xs">Welcome, <?php echo $_SESSION['namalengkap'] ?></span>
							</a>
							
						</li>
						<!-- Control Sidebar Toggle Button -->
						
                                                <li>
                                                    <a href="logout.php"><i class="fa fa-power-off"></i></a>
						</li>
						
					</ul>
				</div>
			</nav>
			 
		</header>
		
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="dist/img/user.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $_SESSION['namalengkap'] ?> </p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				
				<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
				 <!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<?php $modmenu = $_GET['module']; ?>
					 <li>
					  <a href="?module=home">
						<i class="fa fa-th"></i> <span>Dashboard</span> 
					  </a>
					</li>
					<li class="<?php if ($modmenu=='siswa' || $modmenu=='kelas' || $modmenu=='kriteria') echo 'active';  ?> treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="?module=siswa"><i class="fa fa-circle-o"></i>Data Siswa</a></li>
	                        <li><a href="?module=kelas"><i class="fa fa-circle-o"></i>Data Kelas</a></li>
	                        <li><a href="?module=kriteria"><i class="fa fa-circle-o"></i>Data Kriteria</a></li>
	                        <li><a href="?module=kriteria&act=himpunankriteria"><i class="fa fa-circle-o"></i>Data Himpunan Kriteria</a></li>
	                        <li><a href="?module=kriteria&act=klasifikasi"><i class="fa fa-circle-o"></i>Data Klasifikasi</a></li>
						</ul>
					</li>
					<li class="<?php if ($modmenu=='import') echo 'active';  ?> treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>Import/Export</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="?module=import"><i class="fa fa-circle-o"></i>Import Data Siswa</a></li> 
							<li><a href="export.php"><i class="fa fa-circle-o"></i>Export Data Siswa</a></li> 
						</ul>
					</li>
                    <li class="<?php if ($modmenu=='analisa' || $modmenu=='analisasaw') echo 'active';  ?> treeview">
                		<a href="#">
						<i class="fa fa-dashboard"></i> <span>Proses SPK</span> <i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="?module=analisa"><i class="fa fa-search"></i> <span>Proses SPK WP</span></a></li>					  
						<li><a href="?module=analisasaw"><i class="fa fa-search"></i> <span>Proses SPK SAW</span></a></li>					  
						<!-- <li><a href="?module=banding"><i class="fa fa-search"></i> <span>Perbandingan Hasil SPK WP dan SAW</span></a></li>					   -->
					</ul>
					</li>
					
					<li class="<?php if ($modmenu=='rankingkelas'|| $modmenu=='hasilwp') echo 'active';  ?> treeview">
						<a href="#"> 
							<i class="fa fa-files-o"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
                            <li><a href="?module=hasilwp"><i class="fa fa-circle-o"></i>Hasil Analisa WP dan SAW</a>
                            <!-- <li><a href="?module=nilai"><i class="fa fa-circle-o"></i> Laporan WP Pertahun</a></li> -->
                            <li><a href="?module=rankingkelas"><i class="fa fa-circle-o"></i>Ranking Per-Kelas</a></li>
						</ul>
					</li>
					 <li class="<?php if ($modmenu=='admin') echo 'active';  ?> treeview">
					  <a href="#">
						<i class="fa fa-wrench"></i>
						<span>Pengaturan</span>
						<i class="fa fa-angle-left pull-right"></i>
					  </a>
					  <ul class="treeview-menu">
						<li><a href="?module=admin"><i class="fa fa-circle-o"></i> Manajemen Pengguna</a></li>
                                                

						
					  </ul>
					</li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Dashboard
					<small>Control panel</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>
			 
			<section class="content">
				<div class="box box-default color-palette-box">
					<div class="box-body">
						<?php include "content_admin.php"; ?>
					</div>
				</div>
			</section>
		</div>
	</div>
	
	
<?php
}
?>


    



</body>
</html>
<?php
}
}
}
?>
<!--/.fluid-container-->
       <!-- jQuery 2.1.4 -->
	
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
	 <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/ckeditor/ckeditor.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
		$('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
	
	
		
	<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>	
	
		