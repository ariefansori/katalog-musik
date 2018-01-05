<?php
include('config.php');

if (isset($_GET['id'])) {
	$id 	= $_GET['id'];
	$query 	= "SELECT cover,cover_type FROM lagu WHERE id='$id'";
	$result = mysqli_query($koneksi,$query);

	while ($row = mysqli_fetch_array($result)) {
		$imagetype = $row['cover_type'];

		//render image
		header("Content-type: $imagetype");
		echo $row['cover'];
	}
} else {
	header('Location: index.php');
	exit();
}


?>