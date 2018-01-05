<?php
	include('config.php');

	// menjalankan perintah delete
	if(isset($_POST['delete'])) {
		$id = $_POST['id'];

		// hapus record
		$query 	= "DELETE FROM lagu WHERE id = ".$id.";";
		$delete	= mysqli_query($koneksi, $query);
		
		if (!$delete) {
			echo "Gagal menghapus data";
			exit();
		}
	}

	// tampilkan record dari tabel lagu
	$query	= "SELECT id,title,artist FROM lagu ORDER BY id DESC";
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
	<ul class="lagu-container">

		<?php while($row = mysqli_fetch_array($result)) { ?>

		<li class="lagu-item">
			<div class="audio-player js-audio-player">
				<button class="audio-player__control js-control">
					<div class="audio-player__control-icon"></div>
				</button>
				<audio preload="none">
					<source src="<?php echo 'viewlagu.php?id='.$row["id"] ?>"/>
				</audio><img class="audio-player__cover" src="<?php echo 'viewcover.php?id='.$row["id"] ?>"/>
			</div>
			<div class="lagu-desc">
				<h4><b><?php echo $row['title'] ?></b></h4> 
				<p><?php echo $row['artist'] ?></p>
			</div>
				<form class="form-edit" method="post" action="edit-form.php">
					<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
					<button class="button-edit" type="submit" name="edit">EDIT</button>
				</form>
				<form class="form-edit" method="post" action="edit.php">
					<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
					<button class="button-delete" type="submit" name="delete">DELETE</button>
				</form>
				
		</li>

		<?php } ?>

	</ul>
</section>

<footer>
		<p>STMIK DUTA BANGSA</p>
</footer>

<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/index.js"></script>

</body>
</html>