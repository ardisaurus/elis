<?php
class ubahbarang
{
  function getnama($email)
  {
    $getnama=mysql_query("SELECT nama FROM user WHERE email='$email'");
    $nama=mysql_result($getnama,0);
    return $nama;
  }

  function getnamabar($ruang, $kode){
    $getnamabar=mysql_query("SELECT nama FROM $ruang WHERE kode='$kode'");
    $namabar=mysql_result($getnamabar,0);
    return $namabar;
  }

  function gettgl($ruang, $kode){
    $gettgl=mysql_query("SELECT tgl FROM $ruang WHERE kode='$kode'");
    $tgl=mysql_result($gettgl,0);
    return $tgl;
  }

  function getjumlah($ruang, $kode){
    $getjumlah=mysql_query("SELECT jumlah FROM $ruang WHERE kode='$kode'");
    $jumlah=mysql_result($getjumlah,0);
    return $jumlah;
  }

  function getbaik($ruang, $kode){
    $getbaik=mysql_query("SELECT baik FROM $ruang WHERE kode='$kode'");
    $baik=mysql_result($getbaik,0);
    return $baik;
  }

  function getringan($ruang, $kode){
    $getringan=mysql_query("SELECT ringan FROM $ruang WHERE kode='$kode'");
    $ringan=mysql_result($getringan,0);
    return $ringan;
  }

  function getberat($ruang, $kode){
    $getberat=mysql_query("SELECT berat FROM $ruang WHERE kode='$kode'");
    $berat=mysql_result($getberat,0);
    return $berat;
  }

  function getfoto($ruang, $kode){
    $getfoto=mysql_query("SELECT foto FROM $ruang WHERE kode='$kode'");
    $foto=mysql_result($getfoto,0);
    return $foto;
  }

  function getalert($kode){
    switch ($kode) {
    case '1':
      $alert="Total barang kondisi baik, rusak ringan, dan rusak berat harus sesuai jumlah barang.";
      break;
    
    case '2':
      $alert="Query Error";
      break;

    case '2':
      $alert="Data gagal dihapus.";
      break;
  }
  return $alert;
  }
}

include '../proses/config.php';
session_start();
if(!isset($_SESSION["member"])) header("Location: ../");
$ubahbarang = new ubahbarang;
$email=$_SESSION['member'];
$nama=$ubahbarang->getnama($email);
$koderuang=$_SESSION['ruang'];

if (isset($_POST['kode'])) {
	$_SESSION['ubah']['kode']=$_POST['kode'];
}

$ruang=$_SESSION['ruang'];
$kode=$_SESSION['ubah']['kode'];

$namabar=$ubahbarang->getnamabar($ruang, $kode);
$tgl=$ubahbarang->gettgl($ruang, $kode);
$jumlah=$ubahbarang->getjumlah($ruang, $kode);
$baik=$ubahbarang->getbaik($ruang, $kode);
$ringan=$ubahbarang->getringan($ruang, $kode);
$berat=$ubahbarang->getberat($ruang, $kode);
$foto=$ubahbarang->getfoto($ruang, $kode);

if (isset($_GET['alert'])) {
	$kode=$_GET['alert'];
  $alert=$ubahbarang->getalert($kode);
}
?>

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : <?php echo $namabar; ?></title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/sticky-footer.css">
    <link rel="stylesheet" href="../assets/css/costum.css">    
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" media="screen">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <style type="text/css">
    body {
      padding-top: 70px;
      background: url("assets/img/bglogin.png") no-repeat center center fixed;
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
      <!-- Modal ganti Nama -->
		                <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="labelhapus" aria-hidden="true">
		                    <div class="modal-dialog">
		                      <div class="modal-content">
		                            <div class="modal-header">
		                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                <h4 class="modal-title" id="labelhapus">Hapus</h4>
		                            </div>
		                            <div class="modal-body">
		                        <form class="form-horizontal" role="form"  action="proses/hapus.php" method="post">
		                        	<div class="form-group" align="center">
							            Yakin akan menghapus data ini?						            
							                <input type="hidden" name="kode" class="form-control" id="kode" value="$kode" required>		              
							    	</div>
		                        </div>
		                            <div class="modal-footer">
		                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		                                <button type="submit" class="btn btn-danger" name='simpan' value='simpan'>Hapus</button>
		                       </form>
		                         </div>
		                        </div><!-- /.modal-content -->
		                    </div><!-- /.modal-dialog -->
		                </div><!-- /.modal -->
            <!-- Modal ganti Nama -->
                    <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="labelupload" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="labelupload">Pilih Foto Baru</h4>
                                </div>
                                <div class="modal-body">
                            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="proses/ubahbar.php?update=foto" method="post">
                              <div class="form-group" align="center">
                              <input type="file" name="foto" id="foto" required>          
                              <input type="hidden" name="kode" class="form-control" id="kode" value="$kode" required>                 
                              </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Unggah</button>
                           </form>
                             </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
      <div class="row">
        <div class="col-sm-7">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="glyphicon glyphicon-edit"></i> Ubah 
          	<a href="" class="text-danger pull-right" data-toggle="modal" data-target="#hapus">
            <i class="glyphicon glyphicon-remove"></i> Hapus</a>
          </div>
          <div class="panel-body">
            <form  class="form-horizontal" role="form"  action="proses/ubahbar.php?update=barang" method="post">
            <div class="form-group" align="center">
            <table>
              <tr>
                <td>
                  <?php 
                    $loc = 'proses/img/'.$foto;
                    echo"<img align='center' width=200 height=160 src=$loc />";
                  ?>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="" class="text-info" data-toggle="modal" data-target="#upload">
                  <i class="glyphicon glyphicon-upload"></i> Upload Foto Baru...</a>
                </td>
              </tr>
            </table>
            </div>               
            <div class="form-group">
              <label for="nama" class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-7">
                	<input type="text" name="namabar" class="form-control" id="namabar" placeholder="Masukan Nama" value="<?php echo $namabar; ?>" required>
                </div>
            </div>
            <div class="form-group">
              <label for="tgl" class="col-sm-3 control-label">Tgl. Produksi</label>                          
                 <div class="col-sm-7">
                  <div class="input-group date" id='tgl' data-date="" data-date-format="yyyy-mm-dd">
                    <input class="form-control disabled" type="text" name="tgl" value="<?php echo $tgl; ?>" readonly="" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                </div>
            </div>
            <div class="form-group">                
              <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                <div class="col-sm-7">
                    <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah" maxlength="6" value="<?php echo $jumlah; ?>" required>
                </div>                    
            </div>
            <div class="form-group has-success">                
              <label for="baik" class="col-sm-3 control-label">Kondisi Baik</label>
                <div class="col-sm-4">
                    <input type="text" name="baik" class="form-control" id="baik" placeholder="Kondisi Baik" maxlength="6" value="<?php echo $baik; ?>" required>   
                 </div>                    
            </div>
            <div class="form-group has-warning">                
              <label for="ringan" class="col-sm-3 control-label">Rus. Ringan</label>
                <div class="col-sm-4">
                    <input type="text" name="ringan" class="form-control" id="ringan" placeholder="Rusak Ringan" maxlength="6" value="<?php echo $ringan; ?>" required>   
                 </div>                    
            </div>
            <div class="form-group has-error">                
              <label for="berat" class="col-sm-3 control-label">Rusak Berat</label>
                <div class="col-sm-4">
                    <input type="text" name="berat" class="form-control" id="berat" placeholder="Rusak Berat" maxlength="6" value="<?php echo $berat; ?>" required>   
                 </div>                    
            </div>
            <div class="form-group last">
                  <div class="col-sm-offset-4">
                    <input type="submit" name="kirim" value="Simpan" class="btn btn-primary">                     
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