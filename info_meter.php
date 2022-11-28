<?php
require_once 'app/load.php';

if (!isset($_GET['nometer'])) header("location: home.php");
$meter = $_GET['nometer'];
if (cek_meter($meter,'1')) {
	$_SESSION['error'] = '<script>mscAlert("nomor meter tidak ditemukan atau tidak aktif");</script>';
	header("location: home.php");
}
//$nometer = cari_meter($meter);
$langganan = mysqli_fetch_assoc(langgan($meter));
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="res/logo.png">
	<title>Cek meter</title>
	<link rel="stylesheet" type="text/css" href="des/home.css">
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
</head>
<body>
	<?php $pengguna = mysqli_fetch_assoc(cari_meter($meter)); ?>
	<header>
		<div align="center"><br><a href="home.php" class="btn" style="padding: 10px;"><</a>
			<p class="text" style="display: inline;">Cek Tagihan Dan Penggunaan Nomor Meter</p><br>
		</div>
	</header>
	<div id="wrapper" align="center" style="margin-top: 50px;">
		<!-- <p class="text">INFO METER</p> -->
		<table style="width: 100%;">
			<tr>
				<td align="right">
					<table style="width: 25%;">
						<tr><td><p class="text2">Nomor Meter</p></td></tr>
						<tr><td><p class="text2">Pemilik</p></td></tr>
						<tr><td><p class="text2">Alamat</p></td></tr>
						<tr><td><p class="text2">Daya</p></td></tr>
						<tr><td><p class="text2">Berlangganan</p></td></tr>
					</table>
				</td>
				<td align="left">
					<table style="width: 50%;">
						<tr><td><p class="text2">: <?= $pengguna['no_meter']; ?></p></td></tr>
						<tr><td><p class="text2">: <?= $pengguna['pemilik']; ?></p></td></tr>
						<tr><td><p class="text2">: <?= $pengguna['alamat']; ?></p></td></tr>
						<tr><td><p class="text2">: <?= $pengguna['daya']; ?>VA</p></td></tr>
						<tr><td><p class="text2">: <?= $langganan['bulan'] ?> Bulan</p></td></tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div id="info" align="center">
		<p class="text">Belum Terbayar</p>
		<form action="" method="get">
			<input type="hidden" name="nometer" value="<?= $_GET['nometer'] ?>">
			<input type="hidden" name="byr" value="0">
			Bulan : <input type="number" name="bulan" value="1" min="1" max="12" maxlength="2" minlength="1" class="inputext" style="width: 35px;">
			 Tahun : <input type="number" name="tahun" value="2022" maxlength="4" minlength="4" class="inputext" style="width: 50px;">
			 <input type="submit" name="cari" value="Cari" class="button">
			 <a href="info_meter.php?nometer=<?= $_GET['nometer'] ?>" class="button">Refresh</a>
		</form>
		<?php if (cek_bayar($meter,'0')) { ?>
			<div class="box3">
				<p class="text2">Belum Ada</p>
			</div>
		<?php }elseif(isset($_GET['bulan']) && $_GET['byr'] == '0') {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$blum = select_bayar_where($meter,'0', $bulan, $tahun);
			if (mysqli_num_rows($blum) == 0) {
				$_SESSION['alert'] = "<script>mscAlert('Tidak ada Tagihan di bulan $bulan dan tahun $tahun');
				</script>";
				return header('location: info_meter.php?nometer='.$_GET['nometer']);
			}
			while ($belum = mysqli_fetch_assoc($blum)){
			?>
			<div class="box3">
				<table style="width: 100%;">
					<tr>
						<td colspan="2" align="center"><?= bulan($belum['bulan']). " " . $belum['tahun'] ?></td>
					</tr>
					<tr>
						<td>Jumlah Meter</td>
						<td>: <?= $belum['jumlah_meter'] ?> KWH</td>
					</tr>
					<tr>
						<td>Jumlah Tagihan</td>
						<td>: Rp <?= number_format(hitung_tagihan($belum['tarif_kwh'],$belum['jumlah_meter']),2
						) ?></td>
					</tr>
					<tr>
						<?php
						$tgh = hitung_tagihan($belum['tarif_kwh'],$belum['jumlah_meter']);
						$lastid = mysqli_fetch_assoc(tidak_denda($belum['no_meter'],'0'));
						if ($lastid['id'] != $belum['id_tagihan']) {
							if (cek_select_bayar($belum['no_meter'], '0')) $denda = $tgh/100 * 2;
							else return false;
						}else{
							$denda = '0';
						}
						$total = $tgh + $denda + 1600;
						 ?>
						<td>Denda</td>
						<td>: Rp <?= number_format($denda,2) ?></td>
					</tr>
					<tr>
						<td>Jumlah pembayaran</td>
						<td>: Rp <?= number_format($total,2) ?></td>
					</tr>
					<tr>
						<td colspan="2"><br> Note : <br>*denda = 2% total tagihan <br>*Biaya admin = Rp 1,600.00</td>
					</tr>
				</table>
			</div>
		<?php } }else{
			$blum = select_bayar($meter,'0');
			while($belum = mysqli_fetch_assoc($blum)){ ?>
			<div class="box3">
				<table style="width: 100%;">
					<tr>
						<td colspan="2" align="center"><?= bulan($belum['bulan']). " " . $belum['tahun'] ?></td>
					</tr>
					<tr>
						<td>Jumlah Meter</td>
						<td>: <?= $belum['jumlah_meter'] ?> KWH</td>
					</tr>
					<tr>
						<td>Jumlah Tagihan</td>
						<td>: Rp <?= number_format(hitung_tagihan($belum['tarif_kwh'],$belum['jumlah_meter']),2
						) ?></td>
					</tr>
					<tr>
						<?php
						$tgh = hitung_tagihan($belum['tarif_kwh'],$belum['jumlah_meter']);
						$lastid = mysqli_fetch_assoc(tidak_denda($belum['no_meter'],'0'));
						if ($lastid['id'] != $belum['id_tagihan']) {
							if (cek_select_bayar($belum['no_meter'], '0')) $denda = $tgh/100 * 2;
							else return false;
						}else{
							$denda = '0';
						}
						$total = $tgh + $denda + 1600;
						 ?>
						<td>Denda</td>
						<td>: Rp <?= number_format($denda,2) ?></td>
					</tr>
					<tr>
						<td>Jumlah pembayaran</td>
						<td>: Rp <?= number_format($total,2) ?></td>
					</tr>
					<tr>
						<td colspan="2"><br> Note : <br>*denda = 2% total tagihan <br>*Biaya admin = Rp 1,600.00</td>
					</tr>
				</table>
			</div>
			<?php } }?>
		<p class="text">Telah Terbayar</p>
		<form action="" method="get">
			<input type="hidden" name="nometer" value="<?= $_GET['nometer'] ?>">
			<input type="hidden" name="byr" value="1">
			Bulan : <input type="number" name="bulan" value="1" min="1" max="12" maxlength="2" minlength="1" class="inputext" style="width: 35px;">
			 Tahun : <input type="number" name="tahun" value="2022" maxlength="4" minlength="4" class="inputext" style="width: 50px;">
			 <input type="submit" name="cari" value="Cari" class="button">
			 <a href="info_meter.php?nometer=<?= $_GET['nometer'] ?>" class="button">Refresh</a>
		</form>
		<?php if (cek_bayar($meter,'1')) { ?>
			<div class="box3">
				<p class="text2">Belum Ada</p>
			</div>
		<?php }elseif(isset($_GET['bulan']) && $_GET['byr'] == '1') {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$test = select_bayar_where($meter,'1', $bulan, $tahun);
			if (mysqli_num_rows($test) == 0) {
				$_SESSION['alert'] = "<script>mscAlert('Tidak ada yang terbayar di bulan $bulan dan tahun $tahun');
				</script>";
				return header('location: info_meter.php?nometer='.$_GET['nometer']);
			}
			while($sudah = mysqli_fetch_assoc($test)){ ?>
			<div class="box3">
				<table style="width: 100%;">
					<tr>
						<td colspan="2" align="center">
							<?= bulan($sudah['bulan']) . " " . $sudah['tahun']; ?>
						</td>
					</tr>
					<tr>
						<td>Meter Awal</td>
						<td>: <?= $sudah['meter_awal']; ?> KWH</td>
					</tr>
					<tr>
						<td>Meter Akhir</td>
						<td>: <?= $sudah['meter_akhir']; ?> KWH</td>
					</tr>
					<tr>
						<td>Jumlah Meter</td>
						<td>: <?= $sudah['jumlah_meter']; ?> KWH</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="print.php?meter=<?= $sudah['no_meter'].'&id='.$sudah['id_penggunaan'] ?>"><br> Lihat Detail Pembayaran</a></td>
					</tr>
				</table>
			</div>
		<?php } } else {
			$test = select_bayar($meter,'1');
			while($sudah = mysqli_fetch_assoc($test)){ ?>
			<div class="box3">
				<table style="width: 100%;">
					<tr>
						<td colspan="2" align="center">
							<?= bulan($sudah['bulan']) . " " . $sudah['tahun']; ?>
						</td>
					</tr>
					<tr>
						<td>Meter Awal</td>
						<td>: <?= $sudah['meter_awal']; ?> KWH</td>
					</tr>
					<tr>
						<td>Meter Akhir</td>
						<td>: <?= $sudah['meter_akhir']; ?> KWH</td>
					</tr>
					<tr>
						<td>Jumlah Meter</td>
						<td>: <?= $sudah['jumlah_meter']; ?> KWH</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="print.php?meter=<?= $sudah['no_meter'].'&id='.$sudah['id_penggunaan'] ?>"><br> Lihat Detail Pembayaran</a></td>
					</tr>
				</table>
			</div>
		<?php } } ?>
		</div>
		<script src="des/msc-script.js"></script>
		<script src="des/home.js"></script>
		<?php if (isset($_SESSION['alert'])) {
				echo $_SESSION['alert'];
				unset($_SESSION['alert']);
		} ?>
	</body>
	</html>