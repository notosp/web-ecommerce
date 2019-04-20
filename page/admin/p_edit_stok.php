<?php
	include "../../db.php";
	$kd=$_POST['id_buku'];
	$stok = $_POST['stok'];
	$qry=mysql_query("UPDATE stok SET stok = '$stok' WHERE id_buku = '$kd'");
	header('location:buku.php');
?>