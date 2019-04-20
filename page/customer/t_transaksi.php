<?php
include"../../db.php";
session_start();

$query_kode_beli = mysql_query("SELECT * from selesai where id_cus='$_SESSION[id_cus]' && status_beli='order'");
$data_kode_beli = mysql_fetch_array($query_kode_beli);
$kode_beli = $data_kode_beli['kode_beli'];
$query_cek_keranjang = mysql_query("SELECT * from keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli'");
$cek_keranjang = mysql_num_rows($query_cek_keranjang);
$id_buku = $_POST['id_buku'];
$qty = $_POST['qty'];
$harga = $_POST['harga'];
$total_harga = $qty*$harga;

$query_stok = mysql_query("SELECT * from stok where id_buku='$id_buku'");
$data_stok = mysql_fetch_array($query_stok);
$stok = $data_stok['stok'];
$stok_ubah = $stok-$qty;
mysql_query("UPDATE stok set stok='$stok_ubah' where id_buku='$id_buku'");

$query_id_buku = mysql_query("SELECT * FROM keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli' && id_buku='$id_buku'");
$data_id_buku = mysql_fetch_array($query_id_buku);
$idbuku = $data_id_buku['id_buku'];
if($cek_keranjang>=1)
{
if($id_buku==$idbuku)
{
$query_keranjang = mysql_query("SELECT * from keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli' && id_buku='$id_buku'");
$data_keranjang = mysql_fetch_array($query_keranjang);
$qty_asli = $data_keranjang['qty'];
$qty_ubah = $qty_asli+$qty;
$total_harga_ubah = $harga*$qty_ubah;
mysql_query("UPDATE keranjang set qty='$qty_ubah',total_harga='$total_harga_ubah' where id_buku='$id_buku'");
mysql_query("UPDATE pembelian set qty='$qty_ubah',total_harga='$total_harga_ubah' where id_buku='$id_buku'");
header("location:home.php?hal=keranjang");
}
else
{
mysql_query("INSERT into keranjang set kode_beli='$kode_beli',id_cus='$_SESSION[id_cus]',id_buku='$id_buku',qty='$qty',harga='$harga',total_harga='$total_harga'");
mysql_query("INSERT into pembelian set kode_beli='$kode_beli',id_cus='$_SESSION[id_cus]',id_buku='$id_buku',qty='$qty',harga='$harga',total_harga='$total_harga'");
header("location:home.php?hal=keranjang");
}
}
else if($cek_keranjang==0){
$kode = rand();
mysql_query("INSERT into selesai set kode_beli='$kode',id_cus='$_SESSION[id_cus]'");
mysql_query("INSERT into keranjang set kode_beli='$kode',id_cus='$_SESSION[id_cus]',id_buku='$id_buku',qty='$qty',harga='$harga',total_harga='$total_harga'");
mysql_query("INSERT into pembelian set kode_beli='$kode',id_cus='$_SESSION[id_cus]',id_buku='$id_buku',qty='$qty',harga='$harga',total_harga='$total_harga'");
header("location:home.php?hal=keranjang");
}
?>