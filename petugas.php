<?php require_once 'des/header-petugas.php';
if (isset($_GET['hps'])) {
	if (delete_petugas($_GET['hps'])) {
		$_SESSION['alert'] = "<script>mscAlert('Petugas Di telah Hapus');</script>";
		header('location: petugas.php');
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Petugas ini tidak bisa di hapus');</script>";
		header('location: petugas.php');
		die();
	}
}
if (isset($_GET['aktf'])) {
	$id = $_GET['id'];
	$aktf = $_GET['aktf'];
	if (pengaktifan($id,$aktf)) {
		if ($aktf == 1) $_SESSION['alert'] = "<script>mscAlert('Petugas Di Aktifkan');</script>";
		else $_SESSION['alert'] = "<script>mscAlert('Petugas Di NonAktifkan');</script>";
		header('location: petugas.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
		<br>Pilih Tugas :
		<a href="petugas.php?lvl=0" class="class btn btn-primary">catat meter</a>
		<a href="petugas.php?lvl=1" class="class btn btn-primary">Kasir pembayaran</a>
		<a href="petugas.php?lvl=2" class="class btn btn-primary">operator meter</a>
		<a href="petugas.php?lvl=3" class="class btn btn-primary">admin</a>
		<a href="petugas.php" class="class btn btn-primary">refresh</a>
	</div>
	<div class="right"><br><a href="form-petugas.php" class="class btn btn-primary">+Petugas</a></div>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>Nama</th>
			<th>Tugas</th>
			<th>Foto Petugas</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		if (isset($_GET['lvl'])) {
			$lv = $_GET['lvl'];
			if ($lv >= 4 or $lv <= -1) {
				$_SESSION['alert'] = "<script>mscAlert('Tugas Tidak ada!');</script>";
				header('location: petugas.php');
				die();
			}
			$mt = petugas_level($lv);
		}else{
			$mt = petugas();
		}
		while ($ptgs = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $ptgs['username']; ?></td>
				<td><?= tugas($ptgs['level']); ?></td>
				<td><img width="60px" src="img/<?=$ptgs['file'];?>" ?></td>
				<td><?= keaktifan($ptgs['aktif']); ?></td>
				<td>
					<a href="form-petugas.php?ptgs=<?= $ptgs['id_login'] ?>" class="class btn btn-primary">Ubah data</a>
					<?php if ($ptgs['aktif'] == 1): ?>
						<a onclick="nonaktif('<?= $ptgs['id_login'] ?>')" class="class btn btn-primary">Nonaktifkan</a>
						<?php else: ?>
							<a onclick="aktif('<?= $ptgs['id_login'] ?>')" class="class btn btn-primary">Aktifkan</a>
						<?php endif ?>
					</td>
				</tr>
			<?php } ?>
		</table>
		<?php require_once 'des/footer-petugas.php'; ?>