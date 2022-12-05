<?php require_once 'des/header-petugas.php';
$error = '';
$trf = tarif_all();
$id = mysqli_fetch_assoc(last_id_meter());
if (isset($_POST['baru'])) {
	$nama = trim($_POST['nama']);
	$alamat = trim($_POST['alamat']);
	$telp = trim($_POST['telp']);
	$tarif = $_POST['tarif'];
	$ewe = date('Ymd') . '0000';
	$meter = $ewe + $id['id'] + 1;
	if (input_meter($meter,$tarif,$nama,$alamat,$telp)) {
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter atas nama $nama telah ditambahkan');</script>";
		header('location: pelanggan.php?search='. $meter);
		die();
	}else{
		$error = "Ada error";
	}
}
if (isset($_POST['edit'])) {
	$nama = trim($_POST['nama']);
	$alamat = trim($_POST['alamat']);
	$telp = trim($_POST['telp']);
	$tarif = $_POST['tarif'];
	$meter = $_POST['meter'];
	if (update_meter($meter,$tarif,$nama,$alamat,$telp)) {
		$_SESSION['alert'] = "<script>mscAlert('Data di nomor meter : $meter telah di ubah');</script>";
		header('location: pelanggan.php?search='. $meter);
		die();
	}else{
		$error = 'Ada Error';
	}
}
?>
<div style="margin-top: -20px;">
	<form action="form-pelanggan.php" method="post">
		<table style="width: 32%;">
			<?php if (!isset($_GET['mtr'])): ?>
				<tr>
					<td colspan="2"><p class="text1" align="center">Form Tambah Pelanggan</p></td>
				</tr>
				<tr>
					<td colspan="2"><?= $error; ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:<input type="text" name="nama" class="inputext" required></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:<input type="text" name="alamat" class="inputext" required></td>
				</tr>
				<tr>
					<td>Telpon</td>
					<td>:<input type="number" name="telp" class="inputext" maxlength="12" required></td>
				</tr>
				<tr>
					<td>Tarif</td>
					<td>
						: <select name="tarif" class="inputext">
							<?php while($tarif = mysqli_fetch_assoc($trf)){ ?>
								<option value="<?= $tarif['id_tarif'] ?>"><?= $tarif['daya'] ?>VA</option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><a href="pelanggan.php" class="class btn btn-primary">Kembali</a></td>
					<td><input type="submit" name="baru" value="Tambah" class="class btn btn-primary"></td>
				</tr>
				<?php else: ?>
					<?php if (cek_meter($_GET['mtr'],'1')) {
						$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada!');</script>";
						header('location: pelanggan.php');
						die();
					}else{
						$mtr = mysqli_fetch_assoc(cari_meter($_GET['mtr']));
						$select = $mtr['id_tarif'];
					} ?>
				<tr>
				<td colspan="2"><p class="text1" align="center" text size >Form Edit Pelanggan</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:<input type="text" name="nama" class="inputext" value="<?= $mtr['pemilik']; ?>" required></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:<input type="text" name="alamat" class="inputext" value="<?= $mtr['alamat']; ?>" required>
					<input type="hidden" name="meter" value="<?= $mtr['no_meter'] ?>"></td>
				</tr>
				<tr>
					<td>Telpon</td>
					<td>:<input type="text" name="telp" class="inputext" maxlength="12" value="<?= $mtr['telp']; ?>" required></td>
				</tr>
				<tr>
					<td>Tarif</td>
					<td>
						: <select name="tarif" class="inputext">
							<?php while($tarif = mysqli_fetch_assoc($trf)){ ?>
								<option value="<?= $tarif['id_tarif'] ?>" <?php if($select == $tarif['id_tarif']) echo "selected"; ?>><?= $tarif['daya'] ?>VA</option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><a href="pelanggan.php" class="class btn btn-primary">Kembali</a></td>
					<td><input type="submit" name="edit" value="Edit" class="class btn btn-primary"></td>
				</tr>
				<?php endif ?>
			</table>
		</form>
	</div>
	<?php require_once 'des/footer-petugas.php'; ?>