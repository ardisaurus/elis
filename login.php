<?php
session_start();
if (isset($_SESSION['daftar'])) {
  if (isset($_SESSION['daftar']['status'])) {
    $pesan="Pendaftaran telah berhasil";
  }
  unset($_SESSION['daftar']);
  session_destroy();
}

  if (isset($_SESSION['member'])) {
    echo "<script>location.href='beranda'</script>";
  }

if (isset($_GET['alert'])){
  $alert=$_GET['alert'];
  switch ($alert) {
    case '0':
      $alert="Kombinasi Email dan Password tidak cocok.";
      break;

    case '1':
      $alert="Email tidak terdaftar.";
      break;    
  }
}
?>
<div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><i class="glyphicon glyphicon-log-in "></i> Masuk</div>
            <div class="panel-body">
            <?php 
              if (isset($pesan)) {                 
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $pesan ?>                  
                    </div>
                <?php
              }
              if (isset($alert)) {                 
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $alert ?>                  
                    </div>
                <?php
              }

             ?>
              <form class="form-horizontal" role="form" action="proses/login.php" method="post">              
                <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="" required autofocus>
                  </div>
                </div>
                <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                  </div>
                </div>
              <button type="submit" class="btn btn-lg btn-info btn-block">Masuk</button>
              </form>
            </div>
            <div class="panel-footer">
              <a href="index.php?action=daftar">Daftar akun baru?</a>
            </div>
          </div>
          </div>
          </div>