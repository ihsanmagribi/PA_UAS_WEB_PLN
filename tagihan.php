<?php require_once 'des/header-petugas.php';
?>
<div id="atas">
	<?php if (!isset($_GET['bln'])): ?>
	<div class="left"><br>
		<form method="get">
			Cari bulan :<input type="number" name="bln" class="inputext" maxlength="2" max="12" min="1" style="width: 35px;" value="1"> dan tahun :<input type="number" name="thn" class="inputext" maxlength="4" style="width: 50px;" value="2022"><input type="submit" name="cari" value="Cari" class="class btn btn-primary">
		</form>
	</div>
	<?php else: ?>
	<div class="right">
		<br><br><br>
		<a href="excellin.php?bln=<?= $_GET['bln'].'&thn='.$_GET['thn'] ?>" class="class btn btn-primary">Report</a>
		<a href="tagihan.php" class="class btn btn-primary">Kembali</a>
	</div>
	<?php endif ?>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<?php if (!isset($_GET['bln'])): ?>
		<tr>
			<th>No Meter</th>
			<th>Nama</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>Penggunaan</th>
			<th>Status</th>
		</tr>
		<?php
		$mt = select_all_tagihan();
		while ($tarif = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $tarif['no_meter']; ?></td>
				<td><?= $tarif['pemilik']; ?></td>
				<td><?= bulan($tarif['bulan']); ?></td>
				<td><?= $tarif['tahun']; ?></td>
				<td><?= $tarif['jumlah_meter']; ?>KWH</td>
				<td><?= status_tagihan($tarif['status']); ?></td>
			</tr>
		<?php } ?>
		<?php else: ?>
		<tr>
			<th>No Meter</th>
			<th>Nama</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>Penggunaan</th>
			<th>Status</th>
		</tr>
		<?php
		$bulan = $_GET['bln'];
		$tahun = $_GET['thn'];
		$mt = select_tagihan_bln($bulan,$tahun);
		if (mysqli_num_rows($mt) == 0) {
			$bulan = bulan($bulan);
			$_SESSION['alert'] = "<script>mscAlert('Tagihan di Bulan $bulan dan Tahun $tahun tidak ada');
			</script>";
			return header('location: tagihan.php');
		}
		while ($tarif = mysqli_fetch_assoc($mt)) {
			?>
			<tr>
				<td><?= $tarif['no_meter']; ?></td>
				<td><?= $tarif['pemilik']; ?></td>
				<td><?= bulan($tarif['bulan']); ?></td>
				<td><?= $tarif['tahun']; ?></td>
				<td><?= $tarif['jumlah_meter']; ?>KWH</td>
				<td><?= status_tagihan($tarif['status']); ?></td>
			</tr>
		<?php } ?>
		<?php endif ?>
	</table>
	<?php require_once 'des/footer-petugas.php'; ?>