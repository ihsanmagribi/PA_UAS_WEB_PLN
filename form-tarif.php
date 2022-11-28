<?php require_once 'des/header-petugas.php';
$error = '';
if (isset($_POST['baru'])) {
	$daya = trim($_POST['daya']);
	$harga = trim($_POST['harga']);
	if (input_tarif($daya,$harga)) {
		$_SESSION['alert'] = "<script>mscAlert('Tarif dengan Daya $daya dan harga RP $harga telah ditambahkan');</script>";
		header('location: tarif.php');
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Daya tidak bisa sama');</script>";
		header('location: tarif.php');
		die();
	}
}
if (isset($_POST['edit'])) {
	$daya = trim($_POST['daya']);
	$harga = trim($_POST['harga']);
	$id = $_POST['id'];
	if (update_tarif($id,$daya,$harga)) {
		$_SESSION['alert'] = "<script>mscAlert('Data di tarif telah di ubah');</script>";
		header('location: tarif.php');
		die();
	}else{
		$error = 'Ada Error';
	}
}
?>
<div style="margin-top: -20px;">
	<form action="form-tarif.php" method="post">
		<table style="width: 32%;">
			<?php if (!isset($_GET['trf'])): ?>
				
			<tr>
				<td colspan="2"><p class="text1" align="center">Form Tambah Tarif</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>Daya</td>
				<td><input type="number" min="0" name="daya" class="inputext" required></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="number" min="0" name="harga" class="inputext" required></td>
			</tr>
			<tr>
				<td><a href="tarif.php" class="class btn btn-primary">Kembali</a></td>
				<td><input type="submit" name="baru" value="Tambah" class="class btn btn-primary"></td>
			</tr>
			<?php else: ?>
				<?php $trf = mysqli_fetch_assoc(select_tarif($_GET['trf'])); ?>
				<tr>
				<td colspan="2"><p class="text1" align="center">Form Edit Tarif</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>Daya</td>
				<td><input type="text" name="daya" class="inputext" value="<?= $trf['daya']; ?>" readonly></td>
			</tr>
			<tr>
				<td>Tarif KWH</td>
				<td><input type="number" min="0" name="harga" class="inputext" value="<?= $trf['tarif_kwh']; ?>" required>
					<input type="hidden" name="id" value="<?= $trf['id_tarif']; ?>"></td>
			</tr>
			<tr>
				<td><a href="tarif.php" class="class btn btn-primary">Kembali</a></td>
				<td><input type="submit" name="edit" value="Edit" class="class btn btn-primary"></td>
			</tr>
			<?php endif ?>
		</table>
	</form>
</div>
<?php require_once 'des/footer-petugas.php'; ?>