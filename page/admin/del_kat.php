<?php
	include "../../db.php";
	$kd=$_GET['id'];
	$qry=mysql_query("DELETE FROM kategori WHERE id_kategori='$kd'");
	header('location:kategori.php');
?>