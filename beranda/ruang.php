<?php
class classruang
{
  function getnama($email)
  {
    $getnama=mysql_query("SELECT nama FROM user WHERE email='$email'");
    $nama=mysql_result($getnama,0);
    return $nama;
  }

  function getidruang($ruang){
    $a=explode("m", $ruang);
    $idruang=$a[1];
    return $idruang;
  }

  function getnamaruang($idruang){
    $getnamaruang=mysql_query("SELECT nama FROM ruang WHERE id='$idruang'");
    $namaruang=mysql_result($getnamaruang,0);
    return $namaruang;
  }

  function getsumbaik($ruang){
    $getbaik=mysql_query("SELECT SUM(baik) FROM $ruang");
    $baik=mysql_result($getbaik,0);
    return $baik;
  }

  function getsumringan($ruang){
    $getringan=mysql_query("SELECT SUM(ringan) FROM $ruang");
    $ringan=mysql_result($getringan,0);
    return $ringan;
  }

  function getsumberat($ruang){
    $getberat=mysql_query("SELECT SUM(berat) FROM $ruang");
    $berat=mysql_result($getberat,0);
    return $berat;
  }

  function getalert($kode){
    switch ($kode) {
    case '1':
      $pesan="Data berhasil ditambahkan.";
      break;
    
    case '2':
      $pesan="Data berhasil diubah.";
      break;

    case '0':
      $pesan="Data berhasil dihapus.";
      break;
    }
    return $pesan;
  }
}

session_start();
if(!isset($_SESSION["member"]) and !isset($_GET["kode"])) header("Location: ../"); 
include '../proses/config.php';
// ===================================================================
$email=$_SESSION['member'];
$lab = new classruang;
$nama=$lab->getnama($email);
// ===============================END=================================
// ===================================================================
$_SESSION['ruang']=$_GET["kode"];
$ruang=$_GET["kode"];
$idruang=$lab->getidruang($ruang);
$namaruang=$lab->getnamaruang($idruang);
$baik=$lab->getsumbaik($ruang);
$ringan=$lab->getsumringan($ruang);
$berat=$lab->getsumberat($ruang);
// ===============================END=================================
// ===================================================================
if (isset($_GET['pesan'])) {
  $kode=$_GET['pesan'];
  $pesan=$lab->getalert($kode);
}
// ===============================END=================================
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : <?php echo $namaruang; ?></title>
    <!-- Bootstrap core CSS -->
	  <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/sticky-footer.css">
    <link rel="stylesheet" href="../assets/css/costum.css">
    <link rel="stylesheet" href="../assets/css/morris.css">    
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
      	<h3><a href="index.php" class="text-muted"><i class="glyphicon glyphicon-home"></i> Beranda</a> >> <?php echo strtoupper($namaruang); ?> <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#ubahruang"><i class="glyphicon glyphicon-cog"></i></a> <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusruang"><i class="glyphicon glyphicon-remove"></i></a></h3>
        
        <!-- Modal ganti Nama -->
                <div class="modal fade" id="ubahruang" tabindex="-1" role="dialog" aria-labelledby="labelubahruang" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelubahruang">Ubah Ruang</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=namaruang" method="post">
                        <div class="form-group">
                          <label for="nama" class="col-sm-3 control-label">Nama </label>
                            <div class="col-sm-8">
                              <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Baru" required>
                            </div>
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='kirim' value='kirim'>Ubah</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="hapusruang" tabindex="-1" role="dialog" aria-labelledby="labelhapusruang" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapusruang">Hapus Ruang</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=hapusruang" method="post">
                        <div class="form-group text-center">
                                Anda yakin ingin menghapus <?php echo $namaruang; ?>?
                              <input type="hidden" name="id" class="form-control" id="id" required>
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
    <?php if ($baik>0 or $ringan>0 or $berat>0) {?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Grafik Kondisi
        </div>
        <div class="panel-body">
          <div id="morris-bar-chart"></div>                    
        </div>
    </div>
    <?php } ?>
    <div align="right">
      <a href="../beranda/tambah.php" class="btn btn-md btn-info"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
    </div>  
    <br>
  <div class="row">
  <?php
      $query="SELECT * FROM `$ruang`;";
      $result=mysql_query($query); 
      if ($baik>0 or $ringan>0 or $berat>0) {           
      while ($row=mysql_fetch_array($result)) {?>
    <div class="col-lg-3 col-md-4">
            <div class="panel <?php if ($row['baik']==$row['ringan'] and $row['berat']==$row['ringan'] and $row['baik']==$row['berat']) {
                echo "panel-primary";
            }elseif ($row['baik']>=$row['ringan'] and $row['baik']>$row['berat']) {
                echo "panel-green";
            }elseif ($row['baik']<=$row['ringan'] and $row['berat']<$row['ringan']) {
                echo "panel-yellow";
            }elseif ($row['ringan']<=$row['berat'] and $row['baik']<$row['berat']) {
                echo "panel-red";
            }elseif ($row['baik']>=$row['ringan'] and $row['berat']>$row['ringan']) {
                echo "panel-yellow";
            }elseif ($row['ringan']>=$row['baik'] and $row['baik']<$row['berat']) {
                echo "panel-red";
            }
            ?>">
                 <div class="panel-heading">
                  <div class="row">
                        <div class="col-xs-3">
                          <i class="glyphicon 
                            <?php if ($row['baik']==$row['ringan'] and $row['berat']==$row['ringan'] and $row['baik']==$row['berat']) {
                                echo "glyphicon-ok-sign";
                            }elseif ($row['baik']>=$row['ringan'] and $row['baik']>$row['berat']) {
                                echo "glyphicon-info-sign";
                            }elseif ($row['baik']<=$row['ringan'] and $row['berat']<$row['ringan']) {
                                echo "glyphicon-exclamation-sign";
                            }elseif ($row['ringan']<=$row['berat'] and $row['baik']<$row['berat']) {
                                echo "glyphicon-remove-sign";
                            }elseif ($row['baik']>=$row['ringan'] and $row['berat']>$row['ringan']) {
                                echo "glyphicon-exclamation-sign";
                            }elseif ($row['ringan']>=$row['baik'] and $row['baik']<$row['berat']) {
                                echo "glyphicon-remove-sign";
                            }
                            ?> gi-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class="gi-3x"><?php echo $row['jumlah']; ?></div>
                      <div><?php echo strtoupper($row['nama']); ?></div>
                        </div>
                    </div>
                </div>
                <a href="" data-toggle="modal" data-target="#detail<?php echo $row['kode']; ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Detail</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                 <!-- Modal Ganti Email -->
                <div class="modal fade" id="detail<?php echo $row['kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="labeldetail<?php echo $row['kode']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeldetail<?php echo $row['kode']; ?>">Detail</h4>
                            </div>
                            <div class="modal-body">
                        <div class="continer">
                            <div align="center">
                              <?php 
                              $loc = 'proses/img/'.$row['foto'];
                              echo"<img align='center' width=200 height=160 src=$loc />";
                             ?>
                            </div>
                            <div align="center"><h3><?php echo strtoupper($row['nama']); ?></h3></div>
                            <table class="table table-condensed">
                              <tr>
                                <td>Kode</td><td> : </td><td><?php echo $row['kode']; ?></td>
                              </tr>
                              <tr class="btn-info">
                                <td>Tanggal Produksi</td><td> : </td><td><?php echo $row['tgl']; ?></td>
                              </tr>
                              <tr>
                                <td>Jumlah</td><td> : </td><td><?php echo $row['jumlah']; ?></td>
                              </tr>
                              <tr class="btn-success">
                                <td>Kondisi Baik</td><td> : </td><td><?php echo $row['baik']; ?></td>
                              </tr>
                              <tr class="btn-warning">
                                <td>Rusak Ringan</td><td> : </td><td><?php echo $row['ringan']; ?></td>
                              </tr>
                              <tr class="btn-danger">
                                <td>Rusak Berat</td><td> : </td><td><?php echo $row['berat']; ?></td>
                              </tr>                              
                            </table>
                                <form action="ubah.php" method="POST">
                                <input type="hidden" name="kode" id="kode" value="<?php echo $row['kode']; ?>">
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>                                
                                  <button type="submit" name="kirim" class="btn btn-primary">Ubah</button>
                                </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                 
            </div>
        </div>
        <?php }
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
    <script src="../assets/js/morris.js"></script>
    <script src="../assets/js/raphael.js"></script>
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
    <script type="text/javascript">
          $(function() {
              Morris.Bar({
                  element: 'morris-bar-chart',
                  data: [{
                      y: 'Baik',
                      a: <?php echo $baik; ?>
                  }, {
                      y: 'Rusak Ringan',
                      a: <?php echo $ringan; ?>
                  }, {
                      y: 'Rusak Berat',
                      a: <?php echo $berat; ?>
                  }],
                  xkey: 'y',                
                  barColors: ["#8ac4ff"],
                  ykeys: ['a'],
                  labels: ['Tinggi '],
                  hideHover: 'auto',
                  resize: true
              });
          });
          </script> 

</body>
</html>