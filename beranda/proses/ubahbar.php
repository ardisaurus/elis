<?php
class ubahbar
{
	function updatedata($ruang, $namabar, $tgl, $jumlah, $baik, $ringan, $berat, $kode){
		$sql="UPDATE $ruang SET nama='$namabar', tgl='$tgl', jumlah='$jumlah', baik='$baik', ringan='$ringan', berat='$berat' WHERE kode='$kode';";
		mysql_query($sql);			
		echo "<script>location.href='../ruang.php?kode=$ruang&pesan=2'</script>";
		unset($_SESSION['ubah']);
	}

	function getnamafoto($ruang, $kode){
		$getfotolama=mysql_query("SELECT foto FROM $ruang WHERE kode='$kode'");
		$fotolama=mysql_result($getfotolama,0);
		return $fotolama;
	}

	function uploadfoto($fileName, $fotolama){
		$move = move_uploaded_file($_FILES['foto']['tmp_name'],'./img/'.$fileName); //save gambar ke folder
		$delete=unlink('./img/'.$fotolama);
		$newname=$this->createname($fileName);
		rename('./img/'.$fileName, './img/'.$newname);
		return $move;
	}

	function updatefoto($ruang, $fileName, $kode){
		$newname=$this->createname($fileName);
		$sql="UPDATE $ruang SET foto='$newname' WHERE kode='$kode';";
		mysql_query($sql);
		unset($_SESSION['ubah']);			
		echo "<script>location.href='../ruang.php?kode=$ruang&pesan=2'</script>";
	}

	function createname($fileName){
		$time = date("r"); 
		$mtime= md5($time);
		$namaberkas = explode(".", $fileName);
		$file_extension = $namaberkas[count($namaberkas)-1];
		$newname=$mtime.".".$file_extension;
		return $newname;
	}	
}

include 'config.php';
session_start(); 
$kode=$_SESSION['ubah']['kode'];
$ruang=$_SESSION['ruang'];
$update=$_GET['update'];
$ubahbar=new ubahbar;
switch ($update) {
	case 'barang':
		$namabar=$_POST['namabar'];
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
		if ($baik+$ringan+$berat==$jumlah) {
			$ubahbar->updatedata($ruang, $namabar, $tgl, $jumlah, $baik, $ringan, $berat, $kode);
		}else {
			echo "<script>location.href='../ubah.php?alert=1'</script>";
		}
	break;
	
	case 'foto':
		$fotolama=$ubahbar->getnamafoto($ruang, $kode);
		$fileName = $_FILES['foto']['name']; //nama file
		$fileSize = $_FILES['foto']['size']; //ukuran file
		$fileError = $_FILES['foto']['error']; //

			if($fileSize > 0 || $fileError == 0){
		        $move=$ubahbar->uploadfoto($fileName, $fotolama);
		        if($move){
			        $ubahbar->updatefoto($ruang, $fileName, $kode);
			        } else{
		            echo "<h3>Failed! </h3>";
			        }
			    } else {
			        echo "<script>location.href='../ubah.php?alert=1'</script>";
			    }
		break;
}
?>