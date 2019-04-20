<?php
include"../../db.php";
$kode_beli = $_POST['kode_beli'];
$penerima = $_POST['penerima'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kecamatan = $_POST['kecamatan'];
$pos = $_POST['pos'];
$desa = $_POST['desa'];
$rw = $_POST['rw'];
$rt = $_POST['rt'];
$norumah = $_POST['rumah'];
$tgl_order = $_POST['a'];
$telpon = $_POST['telpon'];
$qry_prov = mysql_query("SELECT * from provinsi where provinsi='$provinsi'");
$data_prov = mysql_fetch_array($qry_prov);
$tarif = $data_prov['tarif'];
$qry_selesai = mysql_query("SELECT * from selesai where kode_beli='$kode_beli'");
$data_selesai = mysql_fetch_array($qry_selesai);
$total_bayar=$data_selesai['bayar']+$tarif+$kode_beli;
mysql_query("INSERT into tujuan set kode_beli='$kode_beli',nama_penerima='$penerima',provinsi='$provinsi',kabupaten='$kabupaten',kecamatan='$kecamatan',desa='$desa',rw='$rw',rt='$rt',kode_pos='$pos',no_rumah='$norumah',no_telp='$telpon',tarif='$tarif'");
mysql_query("UPDATE selesai set total_bayar='$total_bayar',tgl_order='$tgl_order' where kode_beli='$kode_beli'");
mysql_query("DELETE from keranjang where kode_beli='$kode_beli'");
header("location:home.php?hal=selesai");
?>