<?php
class tambah
{
	
	function tambahruang($nama){
		$sql="INSERT INTO ruang (nama) Values ('$nama')";
		mysql_query($sql);
		$getid=mysql_query("SELECT MAX(id) FROM ruang");
		$id=mysql_result($getid,0);
		$room='rom'.$id;
		$sql2="CREATE TABLE $room(kode int(5) AUTO_INCREMENT KEY, nama varchar(100), tgl date, jumlah int(10), baik int(10), ringan int(10), berat int(10), foto varchar(255))";
		mysql_query($sql2);
	}

	function createname($fileName){
		$time = date("r");
		$mtime= md5($time);
		$namaberkas = explode(".", $fileName);
		$file_extension = $namaberkas[count($namaberkas)-1];
		$newname=$mtime.".".$file_extension;
		return $newname;
	}

	function uploadfoto($fileName){
		$move = move_uploaded_file($_FILES['foto']['tmp_name'],'./img/'.$fileName);
		$newname=$this->createname($fileName);
		rename('./img/'.$fileName, './img/'.$newname);
	}

	function tambahbarang($ruang, $fileName, $nama, $tgl, $jumlah, $baik, $ringan, $berat){
		$newname=$this->createname($fileName);
		$sql="INSERT INTO $ruang (nama, tgl, jumlah, baik, ringan, berat, foto) Values ('$nama','$tgl', '$jumlah','$baik','$ringan', '$berat', '$newname')";
		mysql_query($sql);			
		echo "<script>location.href='../ruang.php?kode=$ruang&pesan=1'</script>";
		unset($_SESSION['tambah']);
	}
}

session_start(); 
include 'config.php';
$action=$_GET['action'];
$tambah=new tambah;
if (isset($_POST['kirim'])) {
	$action=$_GET['action'];
	switch ($action) {
			case 'ruang':
			$nama=$_POST['nama'];
			$tambah->tambahruang($nama);		
			echo "<script>location.href='../index.php?pesan=1'</script>";
			break;

			case 'barang':
			$ruang=$_SESSION['ruang'];
			$nama=$_POST['nama'];
			$tgl=$_POST['tgl'];
			$jumlah=$_POST['jumlah'];
			$baik=$_POST['baik'];
			if ($baik=="") {
				$baik=0;
			}
			$ringan=$_POST['ringan'];
			if ($ringan=="") {
				$ringan=0;
			}
			$berat=$_POST['berat'];
			if ($berat=="") {
				$berat=0;
			}

			$fileName = $_FILES['foto']['name']; //nama file
		    $fileSize = $_FILES['foto']['size']; //ukuran file
		    $fileError = $_FILES['foto']['error']; //

			$_SESSION['tambah']['nama']=$nama;
			$_SESSION['tambah']['tgl']=$tgl;
			$_SESSION['tambah']['jumlah']=$jumlah;
			$_SESSION['tambah']['baik']=$baik;
			$_SESSION['tambah']['ringan']=$ringan;
			$_SESSION['tambah']['berat']=$berat;

			if ($baik+$ringan+$berat==$jumlah) {
				if($fileSize > 0 || $fileError == 0){
					$tambah->uploadfoto($fileName);
					$tambah->tambahbarang($ruang, $fileName, $nama, $tgl, $jumlah, $baik, $ringan, $berat);
			    } else {
			        echo "<script>location.href='../tambah.php?alert=3'</script>";
			    }
			}else {
				echo "<script>location.href='../tambah.php?alert=1'</script>";
			}
			break;		
	}
}

 ?>