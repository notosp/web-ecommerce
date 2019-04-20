<?php
include"../../db.php";
$kd=$_GET['id'];
$qry=mysql_query("DELETE FROM buku WHERE id_buku='$kd'");
mysql_query("DELETE from stok where id_buku='$kd'");
header('location:buku.php');
?>