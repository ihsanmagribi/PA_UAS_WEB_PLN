<?php require_once 'des/header-petugas.php';
$error = '';
if (isset($_POST['baru'])) {
	$meter = $_POST['meter'];
	//$id_login = $_SESSION['id_login'];
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$awal = $_POST['awal'];
	$akhir = $_POST['akhir'];
	if (input_meter_akhir($meter,$bulan,$tahun,$awal,$akhir)) {
		$_SESSION['alert'] = "<script>mscAlert('meter akhir $akhir telah di input ke no meter $meter');</script>";
		header('location: penggunaan.php?serch='.$_GET['pgn']);
		die();
	}else{
		// $_SESSION['alert'] = "<script>mscAlert('Penggunaan ini telah dibayar!! tidak bisa di hapus');</script>";
		// header('location: penggunaan.php');
		die();
	}
}
if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$akhir = $_POST['akhir'];
	if (update_penggunaan($id,$akhir)) {
		$_SESSION['alert'] = "<script>mscAlert('Meter akhir telah di ubah');</script>";
		header('location: penggunaan.php?serch='.$_GET['ubh']);
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Penggunaan ini telah dibayar! tidak bisa di Ganti ganti');</script>";
		header('location: penggunaan.php');
		die();
	}
}
?>
<div style="margin-top: -20px;">
	<form method="post">
		<table style="width: 32%;">
			<?php if (isset($_GET['pgn'])):
				$pgn = mysqli_fetch_assoc(select_akhir_meter($_GET['pgn']));
					$mter = $_GET['pgn'];
					$bulan = bulan($pgn['bulan'] + 1);
					$bln = $pgn['bulan'] + 1;
					$tahun = $pgn['tahun'];
					if ($bln >= 13) {
						$bln = 1;
						$tahun = $pgn['tahun'] + 1;
					}
					$awal = $pgn['meter_akhir'];
					$tag = 'readonly';
					$tagthn = 'readonly';
				if (cek_penggunaan($_GET['pgn'])) {
					$mter = $_GET['pgn'];
					$bulan = bulan(1);
					$tahun = '2022';
					$awal = '';
					$bln = 1;
					$tag = 'required';
				}
				?>
			<tr>
				<td colspan="2"><p class="text1" align="center">Form Input Meter akhir</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>No meter</td>
				<td><input type="number" name="meter" class="inputext" value="<?= $mter ?>" readonly></td>
			</tr>
			<tr>
				<?php if (cek_penggunaan($_GET['pgn'])): ?>
				<td>Bulan</td>
				<td>
					<select name="bulan" class="inputext">
						<?php $i = 1;
						while ($i <= 12) { 
							if($bln == $i) $ini = 'selected';
							else $ini = '';
						?>
						<option value="<?= $i ?>" <?= $ini ?>><?= bulan($i); ?></option>
						<?php $i++; 
						} ?>
					</select>
					<!-- <?php 
						$bulanini = bulan(date('m'));
					?>
					<input type="text" name="" class="inputext" value="<?= $bulanini ?>" readonly>
					<input type="hidden" name="bulan" class="inputext" value="<?= date('m') ?>"> -->
				</td>
				<?php else: ?>	
				<td>Bulan</td>
				<td>
					<!-- <select name="bulan" class="inputext">
						<?php $i = 1;
						while ($i <= 12) { 
							if($bln == $i) $ini = 'selected';
							else $ini = ''; ?>
						<option value="<?= $i ?>" <?= $ini ?>><?= bulan($i); ?></option>
						<?php $i++; 
						} ?>
					</select> -->
					<input type="text" name="" class="inputext" value="<?= $bulan ?>" readonly>
					<input type="hidden" name="bulan" class="inputext" value="<?= $bln ?>">
				</td>
				<?php endif ?>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input type="number" name="tahun" class="inputext" value="<?= $tahun ?>" <?= $tagthn ?>></td>
			</tr>
			<tr>
				<td>Meter awal</td>
			   <td><input type="number" name="awal" min="0" class="inputext" value="<?= $awal ?>" <?= $tag ?> ></td>
			</tr>
			<tr>
				<td>Meter akhir</td>
				<td><input type="number" name="akhir" min="<?= $awal ?>" class="inputext" required></td>
			</tr>
			<tr>
				<td>
					<?php if (mysqli_num_rows(penggunaan_meter($mter)) == 0): ?>
					<a href="pelanggan.php?search=<?= $mter ?>" class="class btn btn-primary">Kembali</a>
					<?php else: ?>
					<a href="penggunaan.php?serch=<?= $mter ?>" class="class btn btn-primary">Kembali</a>
					<?php endif ?>
				</td>
				<td><input type="submit" name="baru" value="Tambah" class="class btn btn-primary"></td>
			</tr>


			<?php elseif(isset($_GET['ubh'])): ?>
				<?php $pgn = mysqli_fetch_assoc(select_akhir_meter($_GET['ubh'])); 
				$mter = $_GET['ubh'];
				$bulan = bulan($pgn['bulan']);
				$bln = $pgn['bulan'];
				$tahun = $pgn['tahun'];
				//if ($bln >= 13) $tahun = $pgn['tahun'] + 1;
				$akhir = $pgn['meter_akhir'];
				$awal = $pgn['meter_awal'];
				$tag = 'readonly';
				?>
				<tr>
				<td colspan="2"><p class="text1" align="center">Form Edit Tarif</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>No meter</td>
				<td>:<input type="number" name="meter" class="inputext" value="<?= $mter ?>" readonly></td>
			</tr>
			<tr>
				<td>Bulan</td>
				<td>:<input type="text" name="" class="inputext" value="<?= $bulan ?>" readonly>
					<input type="hidden" name="bulan" value="<?= $bln ?>"></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td>:<input type="number" name="tahun" class="inputext" value="<?= $tahun ?>" <?= $tag ?>></td>
			</tr>
			<tr>
				<td>Meter awal</td>
				<td>:<input type="text" name="awal" class="inputext" value="<?= $awal ?>" readonly></td>
			</tr>
			<tr>
				<td>Meter akhir</td>
				<td>:<input type="number" name="akhir" min="<?= $awal ?>" value="<?= $akhir ?>" class="inputext" required><input type="hidden" name="id" value="<?= $pgn['id_penggunaan'] ?>"></td>
			</tr>
			<tr>
				<td><a href="penggunaan.php?serch=<?= $_GET['ubh'] ?>" class="class btn btn-primary">Kembali</a></td>
				<td><input type="submit" name="edit" value=" Edit " class="class btn btn-primary"></td>
			</tr>
			<?php else:
				$_SESSION['alert'] = "<script>mscAlert('ini dibatasi!!');</script>";
				header('location: penggunaan.php');
				die();
				?>
			<?php endif ?>
		</table>
	</form>
</div>
<?php require_once 'des/footer-petugas.php'; ?>