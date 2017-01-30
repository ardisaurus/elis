<?php
class tambah
{
  function getnama($email)
  {
    $getnama=mysql_query("SELECT nama FROM user WHERE email='$email'");
    $nama=mysql_result($getnama,0);
    return $nama;
  }

  function getalert($kode){
    switch ($kode) {
    case '1':
      $alert="Total barang kondisi baik, rusak ringan, dan rusak berat harus sesuai jumlah barang.";
      break;
    
    case '2':
      $alert="Query Error";
      break;

    case '3':
      $alert="Masukan Foto";
     break;
    }
    return $alert;
  }
}

session_start();
if(!isset($_SESSION["member"])) header("Location: ../"); 
include '../proses/config.php';
// ===================================================================
$email=$_SESSION['member'];
$tambah=new tambah;
$nama=$tambah->getnama($email);
$koderuang=$_SESSION['ruang'];
// ===============================END=================================
// ===================================================================
if (isset($_SESSION['tambah'])) {
  $namabar=$_SESSION['tambah']['nama'];
  $tgl=$_SESSION['tambah']['tgl'];
  $jumlah=$_SESSION['tambah']['jumlah'];
  $baik=$_SESSION['tambah']['baik'];
  $ringan=$_SESSION['tambah']['ringan'];
  $berat=$_SESSION['tambah']['berat'];
}
// ===============================END=================================
// ===================================================================
if (isset($_GET['alert'])) {
  $kode=$_GET['alert'];
  $alert=$tambah->getalert($kode);
}
// ===============================END=================================
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : Tambah Inventaris</title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/sticky-footer.css">
    <link rel="stylesheet" href="../assets/css/costum.css">    
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" media="screen">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <style type="text/css">
    body {
      padding-top: 70px;
      background: url("../assets/img/bglogin.png") no-repeat center center fixed;
      background-size:100% auto;
    }
    .gi-3x{font-size: 3em;}
    </style>       
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-bookmark"></i> ELIS</a> 
    <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"><i class="glyphicon glyphicon-user"></i> <?php echo $nama; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../beranda/pengaturan.php">Pengaturan</a></li>
            <li class="divider"></li>
            <li><a href="../index.php?action=logout">Keluar</a></li>
          </ul>  
    </div>
  </nav>
    
    <div class="container">    
<!-- ============================================================= -->
    <?php 
      if (isset($alert)) {                 
       ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $alert ?>                  
        </div>
        <?php } ?>
      <div class="row">
        <div class="col-sm-7">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="glyphicon glyphicon-plus"></i> Tambah</div>
          <div class="panel-body">
            <form  class="form-horizontal" role="form" enctype="multipart/form-data" action="proses/tambah.php?action=barang" method="post">               
            <div class="form-group">
              <label for="nama" class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-7">
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $namabar;
                  } ?>" required>
                </div>
            </div>
            <div class="form-group">
              <label for="tgl" class="col-sm-3 control-label">Tgl. Produksi</label>                          
                 <div class="col-sm-7">
                  <div class="input-group date" id='tgl' data-date="" data-date-format="yyyy-mm-dd">
                    <input class="form-control disabled" type="text" name="tgl" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $tgl;
                  } ?>" readonly="" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                </div>
            </div>
            <div class="form-group">                
              <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                <div class="col-sm-7">
                    <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah" maxlength="6" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $jumlah;
                  } ?>" required>
                </div>                    
            </div>
            <div class="form-group has-success">                
              <label for="baik" class="col-sm-3 control-label">Kondisi Baik</label>
                <div class="col-sm-4">
                    <input type="text" name="baik" class="form-control" id="baik" placeholder="Kondisi Baik" maxlength="6" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $baik;
                  } ?>" required>   
                 </div>                    
            </div>
            <div class="form-group has-warning">                
              <label for="ringan" class="col-sm-3 control-label">Rus. Ringan</label>
                <div class="col-sm-4">
                    <input type="text" name="ringan" class="form-control" id="ringan" placeholder="Rusak Ringan" maxlength="6" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $ringan;
                  } ?>" required>   
                 </div>                    
            </div>
            <div class="form-group has-error">                
              <label for="berat" class="col-sm-3 control-label">Rusak Berat</label>
                <div class="col-sm-4">
                    <input type="text" name="berat" class="form-control" id="berat" placeholder="Rusak Berat" maxlength="6" value="<?php if (isset($_SESSION['tambah'])) {
                    echo $berat;
                  } ?>" required>   
                 </div>                    
            </div>
            <div class="form-group">                
              <label for="foto" class="col-sm-3 control-label">Foto</label>
                <div class="col-sm-4">
                    <input type="file" name="foto" id="foto" required>   
                 </div>                    
            </div>
            <div class="form-group last">
                  <div class="col-sm-offset-4">
                    <input type="submit" name="kirim" value="Tambah" class="btn btn-primary">                     
                      </form>
                      <a href="../beranda/ruang.php?kode=<?php echo $koderuang; ?>" class="btn btn-default">
                      Batal</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- ============================================================= -->
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">NAS &copy; 2015</p>            
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- jQuery Version 1.11.0 -->
    <script src="../assets/js/jquery.js"></script>    
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/collapse.js"></script>
    <script src="../assets/js/transition.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/alert.js"></script>
	<script src="../assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../assets/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>

    <!-- Fungsi datepickier yang digunakan -->
    <script type="text/javascript">
      $('.input-group.date').datetimepicker({
              language:  'id',
              weekStart: 1,
              autoclose: 1,
              todayHighlight: 1,
              startView: 4,
              minView: 2,
              forceParse: 0
      });
    </script>
</body>
</html>
<?php 
unset($_SESSION['tambah']);
 ?>