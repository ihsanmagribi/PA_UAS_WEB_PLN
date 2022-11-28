<?php require_once 'des/header-petugas.php';
if (isset($_GET['pnometer'])) {
	if (aktif_meter($_GET['pnometer'])) {
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter telah di aktifkan kembali');</script>";
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
		if (isset($_GET['search'])) {
			if (cek_meter($_GET['search'],'0')) {
				$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak di hapus!');
				</script>";
				header('location: recovery.php');
				die();
			}else{
				$mt = cari_meter($_GET['search']);
			}
		}else{
			$mt = meter_tarif_off();
		}
		while ($pelanggan = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $pelanggan['no_meter']; ?></td>
				<td><?= $pelanggan['pemilik']; ?></td>
				<td><?= $pelanggan['alamat']; ?></td>
				<td><?= $pelanggan['telp']; ?></td>
				<td><?= $pelanggan['daya']; ?>VA</td>
				<td>
				<?php if($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2'): ?>
					<a onclick="aktfpel('<?= $pelanggan['no_meter'] ?>')" class="class btn btn-primary">Aktifkan</a>
				<?php elseif($_SESSION['level'] == '0'): ?>
					<a href="penggunaan.php?serch=<?= $pelanggan['no_meter'] ?>" class="class btn btn-primary">penggunaan</a>
				<?php endif ?>
				</td>
			</tr>
		<?php } ?>
	</table>
<?php require_once 'des/footer-petugas.php'; ?>