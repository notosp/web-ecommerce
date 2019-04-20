<?php
$query_kode_beli = mysql_query("SELECT * from selesai where id_cus='$_SESSION[id_cus]' && status_beli='order'");
$data_kode_beli = mysql_fetch_array($query_kode_beli);
$kode_beli = $data_kode_beli['kode_beli'];
@$aksi = $_GET['aksi'];
if($aksi=="hapus")
{
	$idker = $_GET['id'];
	$qryker =mysql_query("SELECT * from keranjang where id_keranjang='$idker'");
	$data_ker=mysql_fetch_array($qryker);
	$qty1 = $data_ker['qty'];
	$qrystok =mysql_query("SELECT * from stok where id_buku='$data_ker[id_buku]'");
	$data_stok = mysql_fetch_array($qrystok);
	$qty2 = $data_stok['stok'];
	$stokakhir = $qty1+$qty2;
	mysql_query("UPDATE stok set stok='$stokakhir' where id_buku='$data_ker[id_buku]'");
	mysql_query("DELETE from keranjang where id_keranjang='$idker'");
	mysql_query("DELETE from pembelian where id_keranjang='$idker'");
	header("location:home.php?hal=keranjang");
}
$qrykeranjang = mysql_query("SELECT * from keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli'");
$ttl_harga = $qrykeranjang['total_harga'];
$byr = mysql_fetch_array(mysql_query("SELECT SUM(total_harga) as total_bayar from keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli'"));
$qtot = mysql_fetch_array(mysql_query("SELECT SUM(qty) as qty_total from keranjang where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli'"));
$b = $byr['total_bayar'];
$c = $qtot['qty_total'];
mysql_query("UPDATE selesai set qty_total='$c',bayar='$b' where id_cus='$_SESSION[id_cus]' && kode_beli='$kode_beli'");
?>
<div class="hdkeranjang">
Keranjang Belanja
</div>
<table class="table table-stiped">
<th>judul buku</th>
<th><center>harga</center></th>
<th><center>qty</center></th>
<th><center>total harga</center></th>
<th><center>Aksi</center></th>
<?php
 while($isi_keranjang = mysql_fetch_array($qrykeranjang)){ ?>
<tr>
	<td><?php $id_buku = $isi_keranjang['id_buku']; $qrybuku=mysql_query("SELECT * from buku where id_buku='$id_buku'"); $data_buku=mysql_fetch_array($qrybuku); $judul = $data_buku['judul']; echo $judul;?></td>
	<td><center>Rp.<?php echo number_format($isi_keranjang['harga']); ?>,-</center></td>
	<td><center><?php echo $isi_keranjang['qty'];  ?></center></td>
	<td><center>Rp.<?php echo number_format($isi_keranjang['total_harga']);  ?>,-</center></td>
	<td><center>
	<a href="home.php?hal=keranjang&aksi=hapus&id=<?php echo $isi_keranjang['id_keranjang']; ?>"><span class="glyphicon glyphicon-remove"></span></a></center></td>
</tr>
<?php } ?>
<tr>
	<td colspan="2" style="text-align:center;"><b>Total<b></td><td><center><?php echo $c; ?></center></td><td><center>Rp.<?php echo number_format($b); ?>,-</center></td>
	<td><center><a href="home.php" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping</a>
	<a href="home.php?hal=checkout" class="btn btn-primary"><span class="glyphicon glyphicon-paste"> checkout</span></a></center></td>
</tr>
</table>
