<?php require_once 'des/header-petugas.php';
if (isset($_GET['trf'])) {
	if (hapus_tarif($_GET['trf'])) {
		$_SESSION['alert'] = "<script>mscAlert('Tarif Berhasil Dihapus!!');</script>";
		header('location: tarif.php');
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Gagal karena ada pelanggan yang menggunakan tarif ini');</script>";
		header('location: tarif.php');
		die();
	}
}
?>
<div id="atas">
	<div class="right"><br>
		<a href="form-tarif.php" class="class btn btn-primary">+Tarif baru</a></div>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>Kode Tarif</th>
			<th>Daya</th>
			<th>Tarif perKWH</th>
			<th>Action</th>
		</tr>
		<?php
		$mt = tarif_all();
		while ($tarif = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= kd_tarif($tarif['id_tarif']); ?></td>
				<td><?= $tarif['daya']; ?>VA</td>
				<td>RP <?= number_format($tarif['tarif_kwh'],2); ?></td>
				<td>
					<a href="form-tarif.php?trf=<?= $tarif['id_tarif'] ?>" class="class btn btn-primary">ubah harga</a>
					<a onclick="hpstar('<?= $tarif['id_tarif'] ?>')" class="class btn btn-primary">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php require_once 'des/footer-petugas.php'; ?>