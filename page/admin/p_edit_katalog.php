<?php
	include "../../db.php";
	$kd=$_POST['id_katalog'];
	$katalog = $_POST['katalog'];
	$qry=mysql_query("UPDATE katalog SET katalog = '$katalog' WHERE id_katalog = '$kd'");
	header('location:katalog.php');
?>