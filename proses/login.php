<?php 
include 'config.php';

class login
{
	private $email;
	private $password;

	function cek_email($email)
	{
		$cek="SELECT `email` FROM `user` WHERE `email`='$email';";
		$query_cek=mysql_query($cek);
		while ($hasil=mysql_fetch_array($query_cek)) {
			if ($hasil=$email) {
				return $cek1=1;
			}else{
				return $cek1=0;
			}
		}
	}

	function proseslogin($email, $password){
		if ($this->cek_email($email)==1) {
			$getpassword=mysql_query("SELECT password FROM user WHERE email = '$email'");
			if ($password==mysql_result($getpassword,0)) {
				session_start();
				$_SESSION['member']=$email;
				echo "<script>location.href='../beranda'</script>";
			}else{
				echo "<script>location.href='../index.php?alert=0'</script>";
			}
		}else{
			echo "<script>location.href='../index.php?alert=1'</script>";
		}
	}
}

$email=$_POST['email'];
$password=md5($_POST['password']);

$login = new login;
$login->proseslogin($email, $password);
 ?>