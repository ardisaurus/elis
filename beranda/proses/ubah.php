<?php 
include 'config.php';
session_start();

class ubah
{
	function cek_email($emailbaru)
	{
		$cek="SELECT `email` FROM `user` WHERE `email`='$emailbaru';";
		$query_cek=mysql_query($cek);
		while ($hasil=mysql_fetch_array($query_cek)) {
			if ($hasil=$emailbaru) {
				return $cek1=1;
			}else{
				return $cek1=0;
			}
		}
	}

	function ubahemail($email, $emailbaru)
	{
		if ($this->cek_email($emailbaru)==0 and strpos($email, "@")) {
			$sql="UPDATE user
			SET email = '$emailbaru'
			WHERE email='$email'";
			mysql_query($sql);
			echo "<script>location.href='../pengaturan.php?alert=0'</script>";
			$_SESSION['member']=$emailbaru;
		}else{
			echo "<script>location.href='../pengaturan.php?alert=6'</script>";
		}
	}

	function ubahnama($nama, $email){
		if (strlen($nama)>=4 and strlen($nama)<=50) {
			$sql="UPDATE user
			SET nama = '$nama'
			WHERE email='$email'";
			mysql_query($sql);
			echo "<script>location.href='../pengaturan.php?alert=0'</script>";
		}else{
			echo "<script>location.href='../pengaturan.php?alert=4'</script>";
		}
	}

	function ubahnamaruang($nama, $id, $ruang){
		$sql="UPDATE ruang
		SET nama = '$nama'
		WHERE id='$id'";		
		mysql_query($sql);
		echo "<script>location.href='../ruang.php?kode=$ruang&pesan=2'</script>";
	}

	function hapusruang($id, $ruang){
		$sql="DELETE FROM ruang WHERE id='$id';";
		$sql2="DROP TABLE $ruang;";
			$query="SELECT * FROM `$ruang`;";
		    $result=mysql_query($query);           
		    while ($row=mysql_fetch_array($result)) {
		    	unlink('./img/'.$row['foto']);
		    }
		if (mysql_query($sql) AND mysql_query($sql2)) {				
			echo "<script>location.href='../index.php?pesan=0'</script>";
			unset($_SESSION['ruang']);
		}
	}

	function ubahjenis_kelamin($jenis_kelamin, $email){
		$sql="UPDATE user
		SET jenis_kelamin = '$jenis_kelamin'
		WHERE email='$email'";
		mysql_query($sql);
		echo "<script>location.href='../pengaturan.php?alert=0'</script>";
	}

	function ubahpassword($passwordlama, $passwordbaru, $passwordbaru2, $email){
		$getpassword=mysql_query("SELECT password FROM user WHERE email = '$email'");
		if (md5($passwordlama)==mysql_result($getpassword,0)) {
			if (strlen($passwordbaru)>5 and strlen($passwordbaru)<=12) {
				if ($passwordbaru==$passwordbaru2) {
					$passwordbaru=md5($passwordbaru);
					$sql="UPDATE user
					SET password = '$passwordbaru'
					WHERE email='$email'";
					mysql_query($sql);
					echo "<script>location.href='../pengaturan.php?alert=0'</script>";
				}else{
					echo "<script>location.href='../pengaturan.php?alert=3'</script>";
				}
			}else{
			echo "<script>location.href='../pengaturan.php?alert=2'</script>";
			}
		}else{
			echo "<script>location.href='../pengaturan.php?alert=1'</script>";
		}
	}

	function ubahtgl_lahir($tgl_lahir, $email){
		$sql="UPDATE user
		SET tgl_lahir = '$tgl_lahir'
		WHERE email='$email'";
		mysql_query($sql);
		echo "<script>location.href='../pengaturan.php?alert=0'</script>";
	}	
	
	function ubahno_hp($no_hp, $email){
		if($no_hp!="" and strlen($no_hp)>=10 and strlen($no_hp)<=12 and is_numeric($no_hp)) {
			$sql="UPDATE user
			SET no_hp = '$no_hp'
			WHERE email='$email'";
			mysql_query($sql);
			echo "<script>location.href='../pengaturan.php?alert=0'</script>";
		}else{
			echo "<script>location.href='../pengaturan.php?alert=5'</script>";
		}
	}

	function hapus($password, $email){
		$getpassword=mysql_query("SELECT password FROM user WHERE email = '$email'");
		if (md5($password)==mysql_result($getpassword,0)) {
			$sql="DELETE FROM user WHERE email='$email'";					
			mysql_query($sql);
			unset($_SESSION['member']);
      		session_destroy();	
			echo "<script>location.href='../pengaturan.php?alert=7'</script>";
		}else{
			echo "<script>location.href='../pengaturan.php?alert=1'</script>";
		}
	}
}

$email=$_SESSION['member'];
$action=$_GET['update'];
$ubah = new ubah;
switch ($action) {
	case 'nama':
		$nama=$_POST['nama'];
		$ubah->ubahnama($nama, $email);
	break;

	case 'namaruang':
		$ruang=$_SESSION['ruang'];
		$nama=$_POST['nama'];
		$a=explode("m", $ruang);
		$id=$a[1];
		$ubah->ubahnamaruang($nama, $id, $ruang);
	break;

	case 'hapusruang':
		$ruang=$_SESSION['ruang'];
		$a=explode("m", $ruang);
		$id=$a[1];
		$ubah->hapusruang($id, $ruang);
	break;

	case 'email':
		$emailbaru=$_POST['emailbaru'];
		$ubah->ubahemail($email, $emailbaru);
	break;

	case 'password':
		$passwordlama=$_POST['passwordlama'];
		$passwordbaru=$_POST['passwordbaru'];
		$passwordbaru2=$_POST['passwordbaru2'];
		$ubah->ubahpassword($passwordlama, $passwordbaru, $passwordbaru2, $email);
	break;

	case 'jenis_kelamin':
		$jenis_kelamin=$_POST['jenis_kelamin'];
		$ubah->ubahjenis_kelamin($jenis_kelamin, $email);
	break;

	case 'tgl_lahir':
		$tgl_lahir=$_POST['tgl_lahir'];
		$ubah->ubahtgl_lahir($tgl_lahir, $email);
	break;

	case 'no_hp':
		$no_hp=$_POST['no_hp'];
		$ubah->ubahno_hp($no_hp, $email);
	break;

	case 'hapus':
		$password=$_POST['password'];
		$ubah->hapus($password, $email);
	break;
	
}

 ?>