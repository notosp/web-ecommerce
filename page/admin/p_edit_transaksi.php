<?php
	include "../../db.php";
	$kd=$_POST['kd'];	
	@$a = $_GET['a'];
	if($a=='status kirim')
	{
		$status_kirim = $_POST['status_kirim'];
		$qry=mysql_query("UPDATE selesai SET status_pengiriman='$status_kirim' WHERE kode_beli = '$kd'");
		header('location:pengiriman.php');
	}
	else if($a=='status transaksi')
	{
		$status_beli = $_POST['status_transaksi'];
		$qry=mysql_query("UPDATE selesai SET status_beli='$status_beli' WHERE kode_beli = '$kd'");
		header('location:transaksi.php');
	}
?>