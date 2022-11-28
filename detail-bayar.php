<?php require_once 'des/header-petugas.php';
$error = '';
if (isset($_POST['baru'])) {
	$idtgh = $_POST['idtgh'];
	$meter = $_POST['meter'];
	$badmin = $_POST['badmin'];
	$denda = $_POST['denda'];
	$tagihan = $_POST['tagihan'];
	$tgl = date('Y-m-d');
	$login = $_SESSION['id_login'];
	if (input_pembayaran($login,$idtgh,$tgl,$badmin,$denda,$tagihan)) {
		$_SESSION['alert'] = "<script>mscAlert('Tagihan telah dibayar!');</script>";
		header('location: pembayaran.php?hstr=2&serach='.$meter);
		die();
	}else{
		$error = "Ada error";
	}
}
$tgh = mysqli_fetch_assoc(select_tagihan($_GET['byr']));
//die(print_r($tgh));
$tghn = $tgh['tarif_kwh'] * $tgh['jumlah_meter'];
$tagihan = number_format($tghn,2);
$mx = mysqli_fetch_assoc(max_select_bayar($tgh['no_meter'], '0'));
if ($mx['id'] != $tgh['id_penggunaan']) $denda = $tghn/100 * 2;
else $denda = '0';
$total = $tghn + $denda + 1600;
?>
<div style="margin-top: -20px;">
	<form method="post">
		<table style="width: 32%;">
			<tr>
				<td colspan="2"><p class="text1" align="center">Bayar tagihan</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Nomor Meter <?= $tgh['no_meter'] ?></td>
				<input type="hidden" name="meter" value="<?= $tgh['no_meter'] ?>">
			</tr>
			<tr>
				<td colspan="2" align="center"><?= bulan($tgh['bulan']) ." " . $tgh['tahun']; ?></td>
			</tr>
			<tr>
				<td>Penggunaan</td>
				<td> <?= $tgh['jumlah_meter'] ?> KWH</td>
			</tr>
			<tr>
				<td>Tagihan</td>
				<td>
					 Rp <?= $tagihan ?>
					<input type="hidden" name="tagihan" class="inputext" value="<?= $tghn ?>">
				</td>
			</tr>
			<tr>
				<td>Denda</td>
				<td>
					 Rp <?= number_format($denda,2) ?>
					<input type="hidden" name="denda" class="inputext" value="<?= $denda ?>">
				</td>
			</tr>
			<tr>
				<td>Biaya admin</td>
				<td>
					 Rp 1,600.00
					<input type="hidden" name="badmin" class="inputext" value="1600">
				</td>
			</tr>
			<tr>
				<td>Total</td>
				<td>
					 Rp <?= number_format($total,2) ?>
					<input type="hidden" name="idtgh" value="<?= $tgh['id_tagihan'] ?>">
				</td>
			</tr>
			<tr>
				<td><a href="pembayaran.php?search=<?= $tgh['no_meter'] ?>" class="button">Kembali</a></td>
				<td><input type="submit" name="baru" value="Bayar" class="inp button"></td>
			</tr>
		</table>
	</form>
</div>
<?php require_once 'des/footer-petugas.php'; ?>