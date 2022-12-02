<?php require_once 'des/header-petugas.php';
if (isset($_GET['pnometer'])) {
	if (hapus_meter($_GET['pnometer'])) {
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter telah di Hapus');</script>";
		header('location: pelanggan.php');
		die();
	}else{
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter tidak dapat dihapus karena sesuatu');</script>";
		header('location: pelanggan.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
		<form action="pelanggan.php" method="get">
			Cari Nomor Meter :<input type="search" name="search" class="inputext" maxlength="12">
			<a href="pelanggan.php" class="class btn btn-primary">refresh</a>
		</form>
	</div>
	<div class="right"><br>
		<?php if($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2'): ?>
			<a href="recovery.php" class="class btn btn-primary">Meter mati</a> 
			<a href="form-pelanggan.php" class="class btn btn-primary">+Nomor Meter</a>
		<?php endif ?>
	</div>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>No Meter</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telp</th>
			<th>Daya</th>
			<th>Action</th>
		</tr>
		<?php
		$batas = 3;
		$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
		$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
		$Previous = $halaman - 1;
		$next = $halaman + 1;
		if (isset($_GET['search'])) {
			if (cek_meter($_GET['search'],'1')) {
				$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah hapus!');
				</script>";
				header('location: pelanggan.php');
				die();
			}else{
				$mt = cari_meter($_GET['search']);
			}
		}else{
			$mt = meter_tarif_pg($halaman_awal, $batas);
		}
		$baris = meter_tarif();
		$jumlah_data = mysqli_num_rows($baris);
		$total_halaman = ceil($jumlah_data / $batas);
		$data_petugas = mysqli_query($link, "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif = tarif.id_tarif WHERE aktif='1' limit $halaman_awal, $batas");
		$nomor = $halaman_awal+1;
		while ($pelanggan = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $pelanggan['no_meter']; ?></td>
				<td><?= $pelanggan['pemilik']; ?></td>
				<td width="200"><?= $pelanggan['alamat']; ?></td>
				<td><?= $pelanggan['telp']; ?></td>
				<td><?= $pelanggan['daya']; ?>VA</td>
				<td>
				<?php if($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2'): ?>
					<a href="form-pelanggan.php?mtr=<?= $pelanggan['no_meter'] ?>" class="class btn btn-primary">Ubah data</a>
					<a onclick="hpspel('<?= $pelanggan['no_meter'] ?>')" class="class btn btn-primary">Delete</a>
				<?php elseif($_SESSION['level'] == '0'): ?>
					<a href="penggunaan.php?serch=<?= $pelanggan['no_meter'] ?>" class="class btn btn-primary">Penggunaan</a>
				<?php elseif($_SESSION['level'] == '1'): ?>
					<a href="pembayaran.php?search=<?= $pelanggan['no_meter'] ?>" class="class btn btn-primary">Tagihan</a>
					<a href="pembayaran.php?hstr=1&serach=<?= $pelanggan['no_meter'] ?>" class="class btn btn-primary">Histori</a>
				<?php endif ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
	<?php require_once 'des/footer-petugas.php'; ?>