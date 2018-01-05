<?php
	ini_set('mysql.connect_timeout', 14400);
	ini_set('default_socket_timeout', 14400);

	include('config.php');
	
	//cek jika form telah disubmit
	if(isset($_POST['update'])) {
		
		//info
		$id		= addslashes($_POST['id']);
		$title	= addslashes($_POST['title']);
		$artist	= addslashes($_POST['artist']);
		$album	= addslashes($_POST['album']);
		$genre	= addslashes($_POST['genre']);
		$year	= addslashes($_POST['year']);


		//file lagu
		//cek jika input lagu kosong
		$lagu_kosong = ($_FILES['lagu']["error"] == 4);

		if (!$lagu_kosong) {
			//mengambil data lagu
			$lagu_type	= $_FILES['lagu']['type'];
			$data_lagu	= addslashes(file_get_contents($_FILES['lagu']['tmp_name']));

			//cek tipe data lagu
			if((strstr($lagu_type, "audio/")) == FALSE){
				echo "Tipe data bukan audio";
				exit();
			}

			//update record file lagu
			$query  = "UPDATE lagu SET filelagu='$data_lagu',lagu_type='$lagu_type' WHERE id='$id'";
			$result = mysqli_query($koneksi, $query);
			if(!$result) {
				echo "Data gagal disimpan !!!";
			exit();
			}

		}


		//file cover
		//cek jika input cover kosong
		$cover_kosong    = ($_FILES['cover']['error'] == 4);

		if (!$cover_kosong) {
			//mengambil data cover / album art
			$cover_type	= $_FILES['cover']['type'];
			$data_cover	= addslashes(file_get_contents($_FILES['cover']['tmp_name']));

			//cek tipe data cover
			if((strstr($cover_type, "image/")) == FALSE){
				echo "Tipe data bukan image";
				exit();
			}
			//update record file cover
			$query  = "UPDATE lagu SET cover='$data_cover',cover_type='$cover_type' WHERE id='$id'";
			$result = mysqli_query($koneksi, $query);
			if(!$result) {
				echo "Data gagal disimpan !!!";
			exit();
			}
		}
		

		//update informasi lagu
		$query = "UPDATE lagu SET title='$title', artist='$artist', album='$album', genre='$genre', year='$year' WHERE id='$id'";
		$result = mysqli_query($koneksi, $query);

		if(!$result) {
			echo "Data gagal disimpan !!!";
			exit();
		} else {
			header('Location: index.php');
			exit();
		}
		
	}

	//menampilkan informasi lagu yang dipilih
	if(isset($_POST['edit'])) {
		$id = $_POST['id'];
	}
	$query 	= "SELECT id,title,artist,album,genre,year FROM lagu WHERE id=".$id.";";
	$result	= mysqli_query($koneksi, $query);
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
	<center><h1>Edit Lagu</h1></center>

	<?php while($row = mysqli_fetch_array($result)) { ?>

	<form action="edit-form.php" method="post" enctype="multipart/form-data">
		<label>Title</label>
		<input type="text" name="title" value="<?php echo $row['title'] ?>" required>
		<label>Artist</label>
		<input type="text" name="artist" value="<?php echo $row['artist'] ?>" required>
		<label>Album</label>
		<input type="text" name="album" value="<?php echo $row['album'] ?>" required>
		<label>Genre</label>
		<input type="text" name="genre" value="<?php echo $row['genre'] ?>" required>
		<label>Year</label>
		<input type="text" name="year" maxlength="4" value="<?php echo $row['year'] ?>" required>
		<label>Album Art</label>
		<input type="file" name="cover">
		<label>File Lagu</label>
		<input type="file" name="lagu">
		<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
		<button type="submit" name="update">UPDATE</button>
	</form>

	<?php } ?>
</section>

<footer>
		<p>STMIK DUTA BANGSA</p>
</footer>

</body>
</html>