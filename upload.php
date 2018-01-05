<?php
	ini_set('mysql.connect_timeout', 14400);
	ini_set('default_socket_timeout', 14400);

	include('config.php');
	
	//cek jika form telah disubmit
	if (isset($_POST['upload'])) {
		
		//informasi lagu
		$title		= addslashes($_POST['title']);
		$artist		= addslashes($_POST['artist']);
		$album		= addslashes($_POST['album']);
		$genre		= addslashes($_POST['genre']);
		$year		= addslashes($_POST['year']);

		//mengambil data lagu
		$lagu_type	= $_FILES['lagu']['type'];
		$data_lagu	= addslashes(file_get_contents($_FILES['lagu']['tmp_name']));

		//cek tipe data lagu
		if((strstr($lagu_type, "audio/")) == FALSE){
			echo "Tipe data bukan audio";
			exit();
		}

		//mengambil data cover / album art
		$cover_type	= $_FILES['cover']['type'];
		$data_cover	= addslashes(file_get_contents($_FILES['cover']['tmp_name']));

		//cek tipe data cover
		if((strstr($cover_type, "image/")) == FALSE){
			echo "Tipe data bukan image";
			exit();
		}


		//memasukkan data ke dalam database
		$query = "INSERT INTO lagu VALUES (null,'$title','$artist','$album','$genre','$year','$data_lagu','$lagu_type','$data_cover','$cover_type')";
		$result = mysqli_query($koneksi, $query);

		if(!$result) {
			echo "Data gagal disimpan !!!";
			exit();
		} else {
			header('Location: index.php');
			exit();
		}
		
	}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Katalog Musik</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->  
<link rel="stylesheet" href="assets/base.css">
<link rel="stylesheet" href="assets/fixed-navigation-bar.css">
<link rel="stylesheet" href="assets/audio-player.css">

<body>

<nav class="fixed-nav-bar">
	<div id="menu" class="menu">
		<a class="sitename" href="index.php">Katalog Musik</a>
		<!-- Menu Navigasi  -->
		<a class="show" href="#menu">Menu</a><a class="hide" href="#hidemenu">Menu</a>
		<ul class="menu-items">
			<li><a href="index.php">Home</a></li>
			<li><a href="upload.php">Upload</a></li>
			<li><a href="edit.php">Edit</a></li>
	</ul>
	</div>
</nav>

<section class="content">
	<div class="description">
		<h1>Katalog Musik</h1>
		<p class="summary">Nikmati lagu favorit kamu di sini</p>
		
	</div>
</section>
<section class="article">
	<center><h1>Form Upload</h1></center>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<label>Title</label>
		<input type="text" name="title" required>
		<label>Artist</label>
		<input type="text" name="artist" required>
		<label>Album</label>
		<input type="text" name="album" required>
		<label>Genre</label>
		<input type="text" name="genre" required>
		<label>Year</label>
		<input type="text" name="year" maxlength="4" required>
		<label>Album Art</label>
		<input type="file" name="cover" required>
		<label>File Lagu</label>
		<input type="file" name="lagu" required>
		<button type="submit" name="upload">UPLOAD</button>
	</form>
</section>

<footer>
		<p>STMIK DUTA BANGSA</p>
</footer>

</body>
</html>