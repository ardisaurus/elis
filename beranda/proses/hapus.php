<?php 
class hapus{

	function getfotolama($ruang, $kode)
	{
		$getfotolama=mysql_query("SELECT foto FROM $ruang WHERE kode='$kode'");
		$fotolama=mysql_result($getfotolama,0);
		return $fotolama;
	}

	function proseshapus($ruang, $kode){
		$sql="DELETE FROM $ruang WHERE kode='$kode';";
		mysql_query($sql);
	}
}

include 'config.php';
session_start();
$kode=$_SESSION['ubah']['kode'];
$ruang=$_SESSION['ruang'];
$hapus=new hapus;
$fotolama=$hapus->getfotolama($ruang, $kode);
$del=$hapus->proseshapus($ruang, $kode);
$delete=unlink('./img/'.$fotolama);				
echo "<script>location.href='../ruang.php?kode=$ruang&pesan=0'</script>";
unset($_SESSION['ubah']);
 ?>