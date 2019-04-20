<?php
include"../../db.php";
$kd=$_GET['id'];
$qry=mysql_query("DELETE FROM customer WHERE id_cus='$kd'");
header('location:customer.php');
?>