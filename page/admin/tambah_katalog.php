<?php
	include"../../db.php";
	$kategori = $_POST['kategori'];
	$id_katego = mysql_query("SELECT * from kategori where kategori='$kategori'");
	$id_kategor = mysql_fetch_array($id_katego);
	$id_kategori = $id_kategor['id_kategori'];
	$katalog = $_POST['katalog'];
	mysql_query("INSERT into katalog set id_kategori='$id_kategori',katalog='$katalog'");
	header("location:katalog.php");
?>