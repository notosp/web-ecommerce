<?php
	include "../../db.php";
	$kd=$_GET['id'];
	$qry=mysql_query("DELETE FROM katalog WHERE id_katalog='$kd'");
	header('location:katalog.php');
?>