<?php
  session_start(); 
  if (isset($_REQUEST['status'])) {
    if (isset($_SESSION['daftar'])) {
      $email=$_SESSION['daftar']['email'];
      $nama=$_SESSION['daftar']['nama'];
      $tgl_lahir=$_SESSION['daftar']['tgl_lahir'];
      $no_hp=$_SESSION['daftar']['no_hp'];
    }    
    $status=$_REQUEST['status'];
    switch ($status) {
      case 1:
        $pesan="Periksa kembali email yang anda masukan atau email yang anda masukan telah terdaftar.";
        break;

      case 2:
        $pesan="Query ERROR";
        break;
        
      case 3:
        $pesan="Masukan nama dengan kombinasi 4 sampai 50 karakter.";
        break;

      case 4:
        $pesan="Gunakan kombinasi antara 6 sampai 12 karakter untuk password.";
        break;
        
      case 5:
        $pesan="Masukan password 2 kali dengan benar.";
        break;
        
      case 6:
        $pesan="Masukan Tanggal Lahir";
        break;
        
      case 7:
        $pesan="Masukan nomor HP dengan kombinasi 10 sampai 12 digit angka";
        break;
        
      case 8:
        $pesan="Tandai persetujuan syarat dan ketentuan.";
        break;
    }
  }
?>
<div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading"><i class="glyphicon glyphicon-check"></i> Daftar</div>
            <div class="panel-body">
            <?php 
              if (isset($_REQUEST['status'])) {                 
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $pesan ?>                  
                    </div>
                <?php
              }
             ?>
              <form class="form-horizontal" role="form" action="proses/daftar.php" method="post">
                <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Anda" value="<?php if (isset($_SESSION['daftar'])) { echo $email; }?>" required autofocus>
                  </div>
                </div>                
                <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password Anda" maxlength="12" value="" required>                    
                    <small class="text-muted"><i class="glyphicon glyphicon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</small>
                  </div>
                </div>
                <div class="form-group">
                <label for="password" class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <input type="password" name="passwordconf" class="form-control" id="passwordconf" placeholder="Masukan Kembali Password Anda" maxlength="12" value="" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" value="<?php if (isset($_SESSION['daftar'])) { echo $nama; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_hp" class="col-sm-3 control-label">Tanggal Lahir</label>
                  <div class="col-sm-9">
                     <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                      <input class="form-control disabled" type="text" name="tgl_lahir" value="<?php if (isset($_SESSION['daftar'])) { echo $tgl_lahir; }?>" readonly="">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                     </div>
                  </div>
                </div>
                <div class="form-group">
                <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                  <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option id="laki-laki" value="l" >Laki-laki</option>
                    <option id="perempuan" value="p" >Perempuan</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_hp" class="col-sm-3 control-label">Nomor HP</label>
                  <div class="col-sm-9">
                    <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP Anda" required maxlength="12" value="<?php if (isset($_SESSION['daftar'])) { echo $no_hp; }?>">
                  </div>
                </div>               
                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="checkbox">
                    <label>
                     <input type="checkbox" name="syarat" value="1" />
                      Saya terima syarat dan ketentuan yang berlaku.
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group last">
                  <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" name="kirim" value="Daftar" class="btn btn-primary">
              </form>
             </div>
          </div>
         </div>
    </div>
    </div>
</div>