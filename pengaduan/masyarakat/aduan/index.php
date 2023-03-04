<?php

include '../../config/config.php';
session_start();
 if (isset($_POST['submit'])) {
 	//var_dump($_SESSION['id_petugas']);
	// var_dump($_POST['laporan']);
	// var_dump($_FILES['foto']);
	$nik = $_SESSION['id_petugas'];
	$laporan = $_POST['laporan'];

	$locationTemp = $_FILES['foto']['tmp_name'];
	$destinationFile = '../../assets/img/';

	$serverName = 'http://localhost/assets/img/';

	$fileName = str_replace(' ','',$_FILES['foto']['name']);
	$locationUpload = $destinationFile.$fileName;
	move_uploaded_file($locationTemp,$locationUpload);

	$query =  "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) VALUE(now(), '$nik', '$laporan', '$serverName.$fileName' , '0')";
	//var_dump($query);
	$execQuery = mysqli_query($conn, $query);
	if($execQuery){
		header('Location:/pengaduan/masyarakat/aduan/index.php');
	}else{
		echo '<script>alert("Data Salah")</script>';
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Aduan</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input type="text" name="laporan">
		<input type="file" name="foto">
		<button type="submit" name="submit" value="submit">submit</button>
	</form>

</body>
</html>