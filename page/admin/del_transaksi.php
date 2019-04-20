<?php
	include "../../db.php";
	$kd=$_GET['id'];
	$qry=mysql_query("DELETE FROM selesai WHERE kode_beli='$kd'");
	header('location:transaksi.php');
?>