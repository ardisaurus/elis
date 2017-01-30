<?php
class pengaturan
{
  
  function getnama($email)
  {
    $getnama=mysql_query("SELECT nama FROM user WHERE email='$email'");
    $nama=mysql_result($getnama,0);
    return $nama;
  }

  function getjenis_kelamin($email){
    $getjenis_kelamin=mysql_query("SELECT jenis_kelamin FROM user WHERE email='$email'");
    $jenis_kelamin=mysql_result($getjenis_kelamin,0);
    return $jenis_kelamin;
  }

  function gettgl_lahir($email){
    $gettgl_lahir=mysql_query("SELECT tgl_lahir FROM user WHERE email='$email'");
    $tgl_lahir=mysql_result($gettgl_lahir,0);
    return $tgl_lahir;
  }

  function getno_hp($email){
    $getno_hp=mysql_query("SELECT no_hp FROM user WHERE email='$email'");
    $no_hp=mysql_result($getno_hp,0);
    return $no_hp;
  }

  function getpesan($kode){
    switch ($kode) {
    case '0':
      $alert="Pengaturan akun berhasil diubah.";
      return $alert;
    break;

    case '1':
      $alert="Password yang anda masukan salah.";
      return $alert;
    break;
    
    case '2':
      $alert="Gunakan kombinasi antara 6 sampai 12 karakter untuk password baru.";
      return $alert;
    break;
    
    case '3':
      $alert="Masukan password baru 2 kali dengan benar.";
      return $alert;
    break;
    
    case '4':
      $alert="Masukan nama dengan kombinasi 4 sampai 50 karakter.";
      return $alert;
    break;
    
    case '5':
      $alert="Masukan nomor HP dengan kombinasi 10 sampai 12 digit angka";
      return $alert;
    break;
    
    case '6':
      $alert="Periksa kembali email yang anda masukan atau email yang anda masukan telah terdaftar.";
      return $alert;
    break;

    case '7':
      header("Location: ../");
    break;

  }
  }
}

session_start();
if(!isset($_SESSION["member"])) header("Location: ../"); 
include '../proses/config.php';
$pengaturan=new pengaturan;
// ===================================================================
$email=$_SESSION['member'];
$nama=$pengaturan->getnama($email);
// ===============================END=================================
// ===================================================================
$jenis_kelamin=$pengaturan->getjenis_kelamin($email);
$tgl_lahir=$pengaturan->gettgl_lahir($email);
$no_hp=$pengaturan->getno_hp($email);
// ===============================END=================================
// ===================================================================
if (isset($_GET['alert'])) {
	$kode=$_GET['alert'];
  $alert=$pengaturan->getpesan($kode);
}
// ===============================END=================================
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : Pengaturan</title>
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
      	<h3><i class="glyphicon glyphicon-cog"></i> Pengaturan</h3>
      </div>
      <?php 
      if (isset($alert)) {                 
       ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $alert ?>                  
        </div>
       <?php
        }
       ?>
      <h4><i class="glyphicon glyphicon-check"></i> Akun</h4>
      <table class="table table-condensed">
      	<tr>
      		<td>Email : <?php echo $email; ?></td>
      		<td>
	      		<div align="right"> 
		      		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#email">
		            	<i class="glyphicon glyphicon-envelope"></i> Ubah Email
		            </button>
		            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#password">
		            	<i class="glyphicon glyphicon-lock"></i> Ubah Password
		            </button>			      		
	      		</div>
                <!-- Modal Ganti Email -->
                <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="labelemail" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelemail">Ubah Email</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="proses/ubah.php?update=email" method="post">
				                <div class="form-group">
                              <label for="emailbaru" class="col-sm-3 control-label">Email Baru</label>
					                  <div class="col-sm-8">
					                    <input type="email" name="emailbaru" class="form-control" id="emailbaru" placeholder="Masukan Email Baru" required>
					                  </div>
					                </div>
				                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Email</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal Ganti Password -->
                <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="labelpassword" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelpassword">Ubah Password</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="proses/ubah.php?update=password" method="post">
				                <div class="form-group">
                          		<label for="passwordlama" class="col-sm-3 control-label">Password Lama</label>
					                  <div class="col-sm-8">
					                    <input type="password" name="passwordlama" class="form-control" id="passwordlama" placeholder="Masukan Password Lama" required>
					                  </div>					              
					                </div>
					             <div class="form-group">
					                <label for="passwordbaru" class="col-sm-3 control-label">Password Baru</label>
					                  <div class="col-sm-8">
					                    <input type="password" name="passwordbaru" class="form-control" id="passwordbaru" placeholder="Masukan Password Baru" required>
                                <small class="text-muted"><i class="glyphicon glyphicon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</small>
                            </div>					              
					                </div>
					             <div class="form-group">
					                <label for="passwordbaru2" class="col-sm-3 control-label"></label>
					                  <div class="col-sm-8">
					                    <input type="password" name="passwordbaru2" class="form-control" id="passwordbaru2" placeholder="Masukan Kembali Password baru" required>
					                  </div>					              
					                </div>
				                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Password</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        	<td>
        </tr>
        <tr>
      		<td>Nama : <?php echo $nama; ?></td>
      		<td>
	      		<div align="right"> 
		      		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#nama">
		            	<i class="glyphicon glyphicon-pencil"></i> Ubah Nama
		            </button>
	      		</div>
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="nama" tabindex="-1" role="dialog" aria-labelledby="labelnama" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelnama">Ubah Nama</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="proses/ubah.php?update=nama" method="post">
				                <div class="form-group">
                          <label for="nama" class="col-sm-3 control-label">Nama Baru</label>
					                  <div class="col-sm-8">
					                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Baru" required>
					                  </div>
					                </div>
				                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Nama</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
      		</td>
      	</tr>
      	<tr>
          <td>Jenis Kelamin : <?php if ($jenis_kelamin=='p'){ echo "Perempuan"; }else{ echo "Laki-laki"; } ?></td>
          <td>
            <div align="right"> 
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#jenis_kelamin">
                  <i class="glyphicon glyphicon-random"></i> Ubah Jenis Kelamin
                </button>
            </div>
                <!-- Modal ganti Jenis Kelamin -->
                <div class="modal fade" id="jenis_kelamin" tabindex="-1" role="dialog" aria-labelledby="labeljenis_kelamin" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeljenis_kelamin">Ubah Jenis Kelamin</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=jenis_kelamin" method="post">
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>                          
                            <div class="col-sm-8">
                              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option id="laki-laki" value="l">Laki-laki</option>
                                <option id="perempuan" value="p">Perempuan</option>
                              </select>
                            </div>
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Jenis Kelamin</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          </td>
        </tr>
        <tr>
          <td>Tanggal Lahir : <?php echo $tgl_lahir; ?></td>
          <td>
            <div align="right"> 
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tgl_lahir">
                  <i class="glyphicon glyphicon-calendar"></i> Ubah Tanggal Lahir
                </button>
            </div>
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="tgl_lahir" tabindex="-1" role="dialog" aria-labelledby="labeltgl_lahir" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeltgl_lahir">Ubah Tanggal Lahir</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=tgl_lahir" method="post">
                        <div class="form-group">
                            <label for="tgl_lahir" class="col-sm-3 control-label">Tanggal Lahir</label>                          
                            <div class="col-sm-8">
                              <div class="input-group date" id='lahir' data-date="" data-date-format="yyyy-mm-dd">
                                <input class="form-control disabled" type="text" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>" readonly="" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                            </div>
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Tanggal Lahir</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          </td>
        </tr>
        <tr>
          <td>Nomor HP : <?php echo $no_hp; ?></td>
          <td>
            <div align="right"> 
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#no_hp">
                  <i class="glyphicon glyphicon-phone"></i> Ubah Nomor HP</button>
            </div>
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="no_hp" tabindex="-1" role="dialog" aria-labelledby="labelno_hp" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelno_hp">Ubah Nomor HP</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=no_hp" method="post">
                        <div class="form-group">
                            <label for="no_hp" class="col-sm-3 control-label">Nomor HP</label>                          
                            <div class="col-sm-8">
                              <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP Anda" required maxlength="12"  required>
                            </div>
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Nomor HP</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <div align="right"> 
              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus">
                  <i class="glyphicon glyphicon-remove"></i> Hapus Akun</button>
            </div>
                <!-- Modal ganti Nama -->
                <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="labelhapus" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus">Hapus Akun</h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="proses/ubah.php?update=hapus" method="post">
                        	<div class="form-group">
                        	<label for="password" class="col-sm-3 control-label">Password</label>
					            <div class="col-sm-8">
					                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
					            </div>					              
					    	</div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Hapus Akun</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          </td>
        </tr> 
      </table>

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