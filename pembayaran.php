<?php require_once 'des/header-petugas.php';
if (isset($_GET['search'])) {
	if (cek_meter($_GET['search'],'1')) {
		$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah di hapus!');
		</script>";
		header('location: pelanggan.php');
		die();
	}
}
if (isset($_GET['serach'])) {
	if (cek_meter($_GET['serach'],'1')) {
		$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah di hapus!');
		</script>";
		header('location: pelanggan.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
		<?php if (isset($_GET['cari'])): ?>

		<?php elseif(isset($_GET['serach'])): ?>
		<form method="get">
			<input type="hidden" name="hstr" value="<?= $_GET['serach'] ?>">
			<input type="hidden" name="serach" value="<?= $_GET['serach'] ?>">
			Cari bulan :<input type="number" name="bln" class="inputext" maxlength="2" max="12" min="1" style="width: 35px;" value="1"> dan tahun :<input type="number" name="thn" class="inputext" maxlength="4" style="width: 50px;" value="2022"><input type="submit" name="cari" value="Cari" class="class btn btn-primary">
		</form>
		<?php elseif(isset($_GET['hstr'])): ?>
			<form action="" method="get">
				<input type="hidden" name="hstr" value="1">
				Cari Nomor Meter :<input type="search" name="serach" class="inputext" maxlength="12">
			</form>
		<?php else: ?>
			<form action="" method="get">
				Cari Nomor Meter :<input type="search" name="search" class="inputext" maxlength="12">
			</form>
		<?php endif ?>
		</div>
		<div class="right"><br>
			<?php if ($_SESSION['level'] == '100' or $_SESSION['level'] == '3' or $_SESSION['level'] == '2' && isset($_GET['serach'])): ?>
				<a href="pembayaran.php?hstr=1" class="class btn btn-primary">History pembayaran</a>
			<?php endif ?>
			<?php if (isset($_GET['search'])): ?>
			<a href="pelanggan.php?search=<?= $_GET['search'] ?>" class="class btn btn-primary">Kembali</a>
			<?php elseif(isset($_GET['bln'])): ?>
				<a href="pembayaran.php?hstr=1&serach=<?= $_GET['serach'] ?>" class="class btn btn-primary">Kembali</a>
			<?php elseif(isset($_GET['serach'])): ?>
				<a href="pelanggan.php?search=<?= $_GET['serach'] ?>" class="class btn btn-primary">Kembali</a>
			<?php else: ?>
				<a href="pelanggan.php" class="class btn btn-primary">Kembali</a>
			<?php endif ?>
			</div>
			<div class="clear"></div>
			</div>
			<div id="badan">
			<table id="data">
			<?php if (!isset($_GET['hstr'])): ?>
				<tr>
					<th>No Meter</th>
					<th>Nama</th>
					<th>penggunaan</th>
					<th>Bulan</th>
					<th>Tahun</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php
				if (isset($_GET['search'])) {
			if (cek_meter($_GET['search'],'1')) {
				$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah di hapus!');
				</script>";
				header('location: pelanggan.php');
				die();
			}else{
				$mt = select_tagih_meter($_GET['search']);
				if (mysqli_num_rows($mt) == 0) {
					$_SESSION['alert'] = "<script>mscAlert('Tidak ada tagihan');
				</script>";	
				}
				$min = mysqli_fetch_assoc(min_tagih_meter($_GET['search']));
			}	
				}else{
				$mt = select_tagih_meter('12312');
				$_SESSION['alert'] = "<script>mscAlert('Cari dulu nomor meter');
				</script>";
				}
				while ($byran = mysqli_fetch_assoc($mt)) {
					?>
					<tr>
						<td><?= $byran['no_meter']; ?></td>
						<td><?= ucfirst($byran['pemilik']); ?></td>
						<td><?= $byran['jumlah_meter']; ?> KWH</td>
						<td><?= bulan($byran['bulan']) ?></td>
						<td><?= $byran['tahun']; ?></td>
						<td><?= status_tagihan($byran['status']) ?></td>
						<td>
							<?php if ($min['id'] == $byran['id_penggunaan']): ?>
							<a href="detail-bayar.php?byr=<?= $byran['id_penggunaan'] ?>" class="class btn btn-primary">Detail / Bayar</a>
							<?php else: ?>
							atas dulu
							<?php endif ?>
						</td>
					</tr>
				<?php } ?>
				<?php else: ?>
					<tr>
						<th>No Meter</th>
						<th>Nama</th>
						<th>penggunaan</th>
						<th>Bulan</th>
						<th>Tahun</th>
						<th>Status</th>
						<th>Tanggal bayar</th>
						<th>Action</th>
					</tr>
					<?php
					if(isset($_GET['bln'])){
						$bulan = bulan($_GET['bln']);
						$tahun = $_GET['thn'];
						$mt = select_pembayar_meter_bln($_GET['serach'],$_GET['bln'],$_GET['thn']);
						if (mysqli_num_rows($mt) == 0) {
							$_SESSION['alert'] = "<script>mscAlert('Tidak ada history pembayaran di bulan $bulan dan tahun $tahun');
							</script>";
							return header('location: pembayaran.php?hstr=1&serach='.$_GET['serach']);
						}
					}elseif (isset($_GET['serach'])) {
						$mt = select_pembayar_meter($_GET['serach']);
						if (mysqli_num_rows($mt) == 0) {
							$_SESSION['alert'] = "<script>mscAlert('Tidak ada history pembayaran');
							</script>";	
						}
					}else{
						$mt = select_pembayar();
					}
			//$mt = select_pembayar();
					while ($byran = mysqli_fetch_assoc($mt)) {
						?>
						<tr>
							<td><?= $byran['no_meter']; ?></td>
							<td><?= ucfirst($byran['pemilik']); ?></td>
							<td><?= $byran['jumlah_meter']; ?> KWH</td>
							<td><?= bulan($byran['bulan']) ?></td>
							<td><?= $byran['tahun']; ?></td>
							<td><?= status_tagihan($byran['status']) ?></td>
							<td><?= $byran['tanggal_bayar']; ?></td>
							<td>
								<a href="print.php?meter=<?= $byran['no_meter'] .'&id='. $byran['id_penggunaan'] ?>" class="class btn btn-primary">
									Print
								</a>
							</td>
						</tr>
					<?php } ?>
				<?php endif ?>
			</table>
			<?php require_once 'des/footer-petugas.php'; ?>