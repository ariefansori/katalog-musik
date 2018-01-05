<?php
	include('config.php');
	include('fungsi.php');

	if ($_GET['id']) {
		$id = $_GET['id'];
	} else {
		header('Location: index.php');
		exit();
	}

	$query = "SELECT id,title,artist,album,genre,year,lagu_type FROM lagu WHERE id=".$id.";";
	$result = mysqli_query($koneksi, $query);
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

	<?php while($row = mysqli_fetch_array($result)) { ?>

	<h1>Informasi Lagu</h1>
	<br>

	<img src="<?php echo 'viewcover.php?id='.$row["id"] ?>" alt="<?php echo $row['album'] ?>" height="250" width="250">


	<table>
		<tr>
			<td>Title</td>
			<td>:</td>
			<td><?php echo $row['title'] ?></td>
		</tr>
		<tr>
			<td>Artist</td>
			<td>:</td>
			<td><?php echo $row['artist'] ?></td>
		</tr>
		<tr>
			<td>Album</td>
			<td>:</td>
			<td><?php echo $row['album'] ?></td>
		</tr>
		<tr>
			<td>Genre</td>
			<td>:</td>
			<td><?php echo $row['genre'] ?></td>
		</tr>
		<tr>
			<td>Year</td>
			<td>:</td>
			<td><?php echo $row['year'] ?></td>
		</tr>
	</table>

	<audio preload="none" controls style="width: 300px;">
	  <source src="<?php echo 'viewlagu.php?id='.$row["id"] ?>" type="<?php echo $row["lagu_type"] ?>">
	  Your browser does not support the audio element.
	</audio>

	<br>

	<?php
	  $filename = $row['artist']." - ".$row['title'].".".getExtension($row['lagu_type']);
	?>

	<a class="button-detail" href="<?php echo 'viewlagu.php?id='.$row["id"] ?>" download="<?php echo $filename?>">DOWNLOAD</a>

	<?php } ?>

</section>

<footer>
	<p>STMIK DUTA BANGSA</p>
</footer>

<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/index.js"></script>

</body>
</html>