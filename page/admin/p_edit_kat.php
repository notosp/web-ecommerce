<?php
	include "../../db.php";
	$kd=$_POST['id_kategori'];
	$kategori = $_POST['kategori'];
	$qry=mysql_query("UPDATE kategori SET kategori = '$kategori' WHERE id_kategori = '$kd'");
	header('location:kategori.php');
?>