<?php
include"db.php";
$email = $_POST['email'];
$pass = $_POST['password'];
$q_log_cus = mysql_query("SELECT * from customer where email_cus = '$email' && password_cus='$pass'");
$q_log_su = mysql_query("SELECT * from superuser where email_su = '$email' && password_su = '$pass'");
$q_cus = mysql_fetch_array($q_log_cus);
$q_su = mysql_fetch_array($q_log_su);
$email_su = $q_su['email_su'];
$email_cus = $q_cus['email_cus'];
$nama_cus = $q_cus['nama_cus'];
$id_cus = $q_cus['id_cus'];
$nama_su = $q_su['nama_su'];
$level = $q_su['level'];
if($email_su==$email)
{
	if($level=="owner")
	{
		session_start();
		$_SESSION['email_su'] = $email;
		$_SESSION['password_su'] = $pass;
		$_SESSION['nama_su'] = $nama_su;
		header("location:page/owner/index.php");
	}
	else if($level=="admin")
	{
		session_start();
		$_SESSION['email_su'] = $email;
		$_SESSION['password_su'] = $pass;
		$_SESSION['nama_su'] = $nama_su;
		header("location:page/admin/index.php");	
	}
}
else if($email_cus==$email)
{
	session_start();
	$_SESSION['email_cus'] = $email;
	$_SESSION['password_cus'] = $pass;
	$_SESSION['nama_cus'] = $nama_cus;
	$_SESSION['id_cus'] = $id_cus;
	header("location:page/customer/home.php");
}
else{
	echo"<script type='text/javascript'>alert('Email / Password tidak valid');window.location.href='index.php';</script>";
}
?>