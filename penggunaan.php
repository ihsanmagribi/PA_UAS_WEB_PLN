<?php require_once 'des/header-petugas.php';
if (isset($_GET['pgn'])) {
	if (hapus_penggunaan($_GET['pgn'])) {
		$_SESSION['alert'] = "<script>mscAlert('Penggunaan Berhasil Dihapus!!');</script>";
		header('location: penggunaan.php');
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Penggunaan Sudah terbayar! tidak bisa menghapus');</script>";
		header('location: penggunaan.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
	<?php if (isset($_GET['serch'])): ?>
		<form method="get">
			<input type="hidden" name="serch" value="<?= $_GET['serch'] ?>">
			Cari bulan :<input type="number" name="bln" class="inputext" maxlength="2" max="12" min="1" style="width: 35px;" value="1"> dan tahun :<input type="number" name="thn" class="inputext" maxlength="4" style="width: 50px;" value="2022"><input type="submit" name="cari" value="Cari" class="class btn btn-primary">
		</form>
		<?php else: ?>
		<form action="penggunaan.php" method="get">
			Cari Nomor Meter :<input type="search" name="serch" class="inputext" maxlength="12">
		</form>
		<?php endif ?>
	</div>
	<div class="right"><br>
		<?php if (isset($_GET['serch']) and !isset($_GET['bln'])): ?>
		<a href="pelanggan.php?search=<?= $_GET['serch'] ?>" class="class btn btn-primary">Kembali</a>
		<?php elseif(isset($_GET['bln'])): ?>
		<a href="penggunaan.php?serch=<?= $_GET['serch'] ?>" class="class btn btn-primary">Kembali</a>
		<?php else: ?>
		<a href="pelanggan.php" class="class btn btn-primary">Kembali</a>
		<?php endif ?>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>No meter</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>meter awal</th>
			<th>meter akhir</th>
			<th>Action</th>
		</tr>
		<?php if (isset($_GET['bln']) && isset($_GET['thn'])):
				$bulan = bulan($_GET['bln']);
				$tahun = $_GET['thn'];
				$pgn = penggunaan_meter_bln($_GET['serch'],$_GET['bln'],$_GET['thn']);
				if (mysqli_num_rows($pgn) == 0) {
					$_SESSION['alert'] = "<script>mscAlert('Tidak ada penggunaan di bulan $bulan dan tahun $tahun');</script>";
					return header('location: penggunaan.php?serch='.$_GET['serch']);
				}
		while ($pggn = mysqli_fetch_assoc($pgn)) {
			?>
			<tr>
				<td><?= $pggn['no_meter']; ?></td>
				<td><?= bulan($pggn['bulan']); ?></td>
				<td><?= $pggn['tahun']; ?></td>
				<td><?= $pggn['meter_awal']; ?></td>
				<td><?= $pggn['meter_akhir']; ?></td>
				<td>
					<?php 
					$test = mysqli_fetch_assoc(select_akhir_meter($pggn['no_meter']));
					if ($pggn['status'] == '1'): ?>
						Sudah bayar!
					<?php elseif($test['id_penggunaan'] == $pggn['id_penggunaan']): ?>
					<a href="form-penggunaan.php?ubh=<?= $pggn['no_meter'] ?>" class="class btn btn-primary">Ubah MA</a>
					<?php else: ?>
					Nunggak!!
					<?php endif ?>
				</td>
			</tr>
		<?php } ?>
		<?php else: ?>
		<?php if (isset($_GET['serch'])): ?>
		<?php $tes = mysqli_fetch_assoc(select_akhir_meter($_GET['serch'])); ?>	
		<?php //if ($tes['bulan'] + 1 == date('m') && $tes['tahun'] == '2018'): ?>
		<tr>
			<td><?= $tes['no_meter']; ?></td>
			<td><?= bulan($tes['bulan']+1); ?></td>
			<td><?= $tes['tahun']; ?></td>
			<td><?= $tes['meter_akhir']; ?></td>
			<td> -- </td>
			<td>
				<a href="form-penggunaan.php?pgn=<?= $tes['no_meter'] ?>" class="class btn btn-primary">+ MA</a>
			</td>
		</tr>
		<?php //endif ?>
		<?php endif ?>
		<?php
		if (isset($_GET['serch'])) {
			if (cek_meter($_GET['serch'],'1')) {
				$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah di hapus!');
				</script>";
				header('location: pelanggan.php');
				die();
			}else{
				$pgn = penggunaan_meter($_GET['serch']);
				if (mysqli_num_rows($pgn) == 0) {
					$_SESSION['alert'] = "<script>mscAlert('Belum ada penggunaan, Input baru');</script>";
					header('location: form-penggunaan.php?pgn='.$_GET['serch']);
					die();
				}
			}
		}else{
			$pgn = penggunaan_meter('12345');
			$_SESSION['alert'] = "<script>mscAlert('Cari dahulu no meter');</script>";
		}
		while ($pggn = mysqli_fetch_assoc($pgn)) {
			?>
			<tr>
				<td><?= $pggn['no_meter']; ?></td>
				<td><?= bulan($pggn['bulan']); ?></td>
				<td><?= $pggn['tahun']; ?></td>
				<td><?= $pggn['meter_awal']; ?></td>
				<td><?= $pggn['meter_akhir']; ?></td>
				<td>
					<?php 
					$test = mysqli_fetch_assoc(select_akhir_meter($pggn['no_meter']));
					if ($pggn['status'] == '1'): ?>
						Sudah bayar!
					<?php elseif($test['id_penggunaan'] == $pggn['id_penggunaan']): ?>
					<a href="form-penggunaan.php?ubh=<?= $pggn['no_meter'] ?>" class="class btn btn-primary">Ubah MA</a>
					<?php else: ?>
					Nunggak!!
					<?php endif ?>
				</td>
			</tr>
		<?php } ?>
		<?php endif ?>
	</table>
	<?php require_once 'des/footer-petugas.php'; ?>