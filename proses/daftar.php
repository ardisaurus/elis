<?php
session_start();
include "config.php";

class daftar{
	private $email;
	private $nama;
	private $password;
	private $passwordconf; 
	private $jenis_kelamin;
	private $tgl_lahir;
	private $no_hp;

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

	function prosesdaftar($email, $nama, $password, $passwordconf, $jenis_kelamin, $tgl_lahir, $no_hp){
	$_SESSION['daftar']['email']=$email;	
	$_SESSION['daftar']['nama']=$nama;		
	$_SESSION['daftar']['tgl_lahir']=$tgl_lahir;
	$_SESSION['daftar']['no_hp']=$no_hp;

	if ($this->cek_email($email)==1 and strpos($email, "@")) {
			echo "<script>location.href='../index.php?action=daftar&status=1'</script>";
		}else{
			if (strlen($nama)>=4 and strlen($nama)<=50) {				
				if (strlen($password)>5 and strlen($password)<=12) {
					if ($password==$passwordconf) {
						$password=md5($password);
						if ($tgl_lahir!="") {
							if ($no_hp!="" and strlen($no_hp)>=10 and strlen($no_hp)<=12 and is_numeric($no_hp)) {
								if (isset($_POST['syarat'])) {
									$_SESSION['daftar']['status']=1;
									$sql="INSERT INTO user(email, nama, password, jenis_kelamin, tgl_lahir, no_hp) Values ('$email','$nama', '$password','$jenis_kelamin', '$tgl_lahir', '$no_hp')";
									if (mysql_query($sql)) {
										echo "<script>location.href='../index.php'</script>";
										}else{
											echo "<script>location.href='../index.php?action=daftar&status=2'</script>";
										}
									}else{
										echo "<script>location.href='../index.php?action=daftar&status=8'</script>";
									}								
								}else{
									echo "<script>location.href='../index.php?action=daftar&status=7'</script>";
								}
							}else{
								echo "<script>location.href='../index.php?action=daftar&status=6'</script>";
							}
						}else{
							echo "<script>location.href='../index.php?action=daftar&status=5'</script>";
						}
					}else{
						echo "<script>location.href='../index.php?action=daftar&status=4'</script>";
					}
				}else{
					echo "<script>location.href='../index.php?action=daftar&status=3'</script>";					
				}
			}
	
	}
}

if (isset($_POST['kirim'])) {
	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$password = $_POST['password'];
	$passwordconf = $_POST['passwordconf']; 
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$no_hp = $_POST['no_hp'];

$daftar = new daftar;
$daftar->prosesdaftar($email, $nama, $password, $passwordconf, $jenis_kelamin, $tgl_lahir, $no_hp);

}

 ?>