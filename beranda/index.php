<?php
class beranda
{
  function getnama($email)
  {
    $getnama=mysql_query("SELECT nama FROM user WHERE email='$email'");
    $nama=mysql_result($getnama,0);
    return $nama;
  }

  function getpesan($kode){
    switch ($kode) {
    case '1':
      $pesan="Data berhasil ditambahkan.";
      return $pesan;
      break;

    case '0':
      $pesan="Data berhasil dihapus.";
      return $pesan;
      break;
    }
  }
  
}

session_start();
if(!isset($_SESSION["member"])) header("Location: ../"); 
include '../proses/config.php';
$beranda = new beranda;
$email=$_SESSION['member'];
$nama=$beranda->getnama($email);
if (isset($_GET['pesan'])) {
  $kode=$_GET['pesan'];
  $pesan=$beranda->getpesan($kode);
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : Beranda</title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/sticky-footer.css">
    <link rel="stylesheet" href="../assets/css/costum.css">    
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" media="screen">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <style type="text/css">
    body {
      padding-top: 30px;
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
	<div class="page-header">
      	<h3><i class="glyphicon glyphicon-home"></i> Beranda</h3>
      </div>
    <?php 
      if (isset($pesan)) {                 
       ?>
        <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $pesan ?>                  
        </div>
       <?php
        }
       ?>  
    <div align="right"> 
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#nama">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </button>
            </div>
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="nama" tabindex="-1" role="dialog" aria-labelledby="labelnama" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelnama">Tambah Ruang</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/tambah.php?action=ruang" method="post">
                        <div class="form-group">
                          <label for="nama" class="col-sm-3 control-label">Nama </label>
                            <div class="col-sm-8">
                              <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Baru" required>
                            </div>
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='kirim' value='kirim'>Tambah</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
    <br>
  <div class="row">
  <?php 
      $query="SELECT * FROM `ruang`;";
      $result=mysql_query($query);
      if ($result) {?>
      <div class="table-responsive">
      <table class="table table-hover table-striped">
      <thead>
        <tr class="info">
          <td class="text-center" colspan="2">
            Ruang
          </td>
        </tr>
      </thead>
      <?php
      $a=1;           
      while ($row=mysql_fetch_array($result)) {?>
        <tr>
          <td>
          <?php echo strtoupper($row['nama']); ?>            
          </td>
          <td class="text-right">
            <a href="../beranda/ruang.php?kode=rom<?php echo $row['id']; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Lihat</a>
          </td>
        </tr>
        <?php }?>
        </table>
        </div>
        <?php
        }else{ ?>
            <div class="alert alert-danger">
            <i class="glyphicon glyphicon-remove-sign"></i> Data tidak tersedia.
            </div>
        <?php } ?>
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