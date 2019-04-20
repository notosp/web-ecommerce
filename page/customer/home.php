<?php
include"../../db.php";
session_start();
$idcos = $_SESSION['id_cus'];
$nama = $_SESSION['nama_cus'];
@$pesan = $_GET['pesan'];
if($pesan=="statusorder")
{
	echo"<script type='text/javascript'>alert('Anda belum melakukan pembayaran,anda tidak dapat melakukan pembelian lagi');</script>";
}
else if($pesan=="status belum kirim")
{
	echo"<script type='text/javascript'>alert('pembayaran anda sudah lunas,barang belum di kirim.');</script>";
}
else if($pesan=="status belum terima")
{
	echo"<script type='text/javascript'>alert('Harap Lakukan konfirmasi terima terlebih dahulu di halaman konfirmasi(jika anda sudah menerima barang)');</script>";
}
if(!isset($_SESSION['email_cus'])){
	header("location:../../index.php?pesan=login");
}
@$pesan = $_GET['pesan'];
if($pesan=="batal")
{
	echo"<script type='text/javascript'>alert('anda berhasil membatal kan transaksi anda');</script>";
}
else if($pesan=="stok_kurang")
{
	$idbuk = $_GET['idbuku'];
	$qry_stok = mysql_query("SELECT * from stok where id_buku='$idbuk'");
	$stok= mysql_fetch_array($qry_stok);
	$stokasli = $stok['stok'];
	echo"<script type='text/javascript'>alert('stok yang tersisa hanya $stokasli');</script>";
}
else if($pesan=="belum checkout")
{
	echo"<script type='text/javascript'>alert('Anda belum melakukan chekout');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>bakolbuku.com</title>
	<link rel="shorcut icon" href="../../img/buku.png">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui/jquery-ui.js"></script>
</head>
<body>
<div id="head">
	<div class="hdkiri">
	<a href="index.php">bakol<b>buku</b>.com</a>
	</div>
	<div class="hdkanan">
	<form action="qry_cari.php" method="post">
		<input type="text" name="cari" placeholder="cari buku yang anda inginkan disini.." class="cari">
		<input type="submit" name="search" value="cari" class="tombolcari">
	</form>
	</div>
</div>
<div id="menu">
	<div class="menukiri">
		<ul>
		<li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Beranda</a></li>
		<li><a href="home.php?page=cara"><span class="glyphicon glyphicon-question-sign"></span> Cara Beli</a></li>
		<li><a href="home.php?page=tentang"><span class="glyphicon glyphicon-info-sign"></span> Tentang Kami</a></li>
		</ul>
	</div>
	<div class="menukanan">
	<?php
	$query_kode_beli = mysql_query("SELECT * from selesai where id_cus='$_SESSION[id_cus]' && status_beli='order'");
	$data_kode_beli = mysql_fetch_array($query_kode_beli);
	$kode_beli = $data_kode_beli['kode_beli'];
	@$id_kategori = $_GET['kategori'];
	@$id_katalog = $_GET['katalog'];
	@$keranjong = mysql_fetch_array(mysql_query("SELECT SUM(qty) as qty_total from keranjang where id_cus='$idcos' && kode_beli='$kode_beli'"));
	@$total_keranjang = $keranjong['qty_total'];
	@$aksi = $_GET['aksi'];
	?>
	<ul>
		<li><a href="home.php?hal=keranjang"><span class="glyphicon glyphicon-shopping-cart"></span> keranjang(<?php echo '0'.$total_keranjang; ?>)</a></li>
		<?php
		$qryba = mysql_query("SELECT * from selesai where id_cus='$idcos' && status_beli='order' || status_beli='lunas'");
		$databa = mysql_fetch_array($qryba);
		$tot_bbb = $databa['total_bayar'];
		$q_cek_k = mysql_query("SELECT * from selesai where id_cus='$idcos' && status_beli='order' || status_beli='lunas' && status_pengiriman='belum dikirim' || status_pengiriman='dikirim'");
		$cek_k = mysql_num_rows($q_cek_k);
		if($cek_k>=1 && $tot_bbb>0){
		?>
		<li><a href="home.php?hal=selesai"><span class="glyphicon glyphicon-check"></span> Konfirmasi Pembelian</a></li>
		<?php } ?>
		
		<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $nama; ?></a></li>
		<li><a href="keluar.php"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
	</ul>
	</div>
</div>
<div id="content">
	<div id="contentkiri">
		<div class="welcome">
		<?php
		@$page = $_GET['page'];
			@$hal = $_GET['hal'];
			if($page=="tentang")
			{
				include("../../tentang.php");
			}
			else if($page=="cara")
			{
				include("../../carabeli.php");
			}
			else if($aksi=="" && $id_kategori==0 && $id_katalog==0 && $hal==""){
			include("welcome.php"); 
		}
		if($hal=="keranjang")
		{
			include("t_keranjang.php");
		}
		else if($hal=="checkout")
		{
			include("checkout.php");
		}
		else if($hal=="selesai")
		{
			include("selesai.php");
		}
		?>
		</div>
		<div class="produk" style="margin-top:0px;">
		<?php if($hal==""){ ?>
			<div class="hdproduk">
				Silahkan pilih buku-buku di bawah ini
			</div>
			<?php }
			$q_seleksi_buku = mysql_query("SELECT * from buku where id_kategori='$id_kategori'");
			$q_seleksi_buku1 = mysql_query("SELECT * from buku where id_katalog='$id_katalog'");
			$q_buku = mysql_query("SELECT * from buku");
			if($id_kategori>=1 && $id_katalog>=1) { while($seleksi_buku1=mysql_fetch_array($q_seleksi_buku1)){?>
			<div class="col-md-3">
			<div class="tamp_produk" style="border:none">
				<?php include("seleksi_produk1.php"); ?>
			</div>
			</div>
			<?php }}
			else if($id_kategori>=1) { while($seleksi_buku=mysql_fetch_array($q_seleksi_buku)){?>
			<div class="col-md-3">
			<div class="tamp_produk" style="border:none;">
				<?php include("seleksi_produk.php"); ?>
			</div>
			</div>
			<?php }} 
			else if($id_katalog>=1) { while($seleksi_buku1=mysql_fetch_array($q_seleksi_buku1)){?>
			<div class="col-md-3">
			<div class="tamp_produk" style="border:none;">
				<?php include("seleksi_produk1.php"); ?>
			</div>
			</div>
			<?php }} 
			if($aksi=="cari"){
			 $search= $_GET['search'];
			 $qry_cari_buku = mysql_query("SELECT * from buku where judul like '%$search%'");
			 $cek = mysql_num_rows($qry_cari_buku);
			 if($cek>=1){
			 while($pencarian=mysql_fetch_array($qry_cari_buku)){ ?>
			<div class="col-md-3">
			<div class="tamp_produk" style="border:none;">
				<?php include("cari_produk.php"); ?>
			</div>
			</div>
			<?php }}}
			else if($aksi=='' && $id_katalog==0 && $id_kategori==0 && $hal=="")
			{			
			while($buku = mysql_fetch_array($q_buku)){
			?>
	
			<div class="col-md-3" >
			<div class="tamp_produk" style="border:none;">
				<?php include("produk.php"); ?>
			</div>
			</div>
			<?php } } ?>
		</div>
	</div>
	<div id="contentkanan">
		<div class="navkanan">
			<?php include("nav.php") ?>
		</div>
		<div class="navkanan">
		<?php
		$q_seleksi_katalog = mysql_query("SELECT * from katalog where id_kategori='$id_kategori'");
		if($id_kategori==0){
		 include("katalog.php");
		}else{ 
			include("seleksi_katalog.php");
		}
		 ?>
		</div>
	</div>
</div>

<!-- modal detail buku  -->
<div id="detail" class="modal fade">

</div>

<div id="footer" style="margin-top:1250px;">
	<?php include("../../footer.php"); ?>
</div>
</body>
</html>