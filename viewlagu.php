<?php
include('config.php');

if (isset($_GET['id'])) {
	$id 	= $_GET['id'];
	$query 	= "SELECT filelagu,lagu_type FROM lagu WHERE id='$id'";
	$result = mysqli_query($koneksi,$query);

	while ($row = mysqli_fetch_array($result)) {
		$audiotype = $row['lagu_type'];

		//render image
		header("Content-type: $audiotype");
		echo $row['filelagu'];
	}
} else {
	header('Location: index.php');
	exit();
}


?>