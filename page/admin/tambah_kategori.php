<?php
	include"../../db.php";
	$kategori = $_POST['kategori'];
	mysql_query("INSERT into kategori set kategori='$kategori'");
	header("location:kategori.php");
?>