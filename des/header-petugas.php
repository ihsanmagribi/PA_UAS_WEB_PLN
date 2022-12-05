<?php require_once 'app/load.php';
if (!isset($_SESSION['login'])) {
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="res/logo.png">
	<title>Petugas!!!</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="des/petugas.css">
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
</head>
<body>
<p class="text" align="center">Hallo <?= $_SESSION['petugas']; ?></p>
	<div id="tugas" align="center">
		<div id="menu" class="left">
			<p class="text1">Menu</p>
			<nav>
				<?php if ($_SESSION['level'] == '100' or $_SESSION['level'] == '3'): ?>
					<div class="btn-group-vertical" role="group" aria-label="Vertical button group">
					<a href="tarif.php" class="class btn btn-warning">Tarif</a>
					<a href="petugas.php" class="class btn btn-warning">Petugas</a>
					<a href="pelanggan.php" class="class btn btn-warning">Pelanggan</a>
					<a href="penggunaan.php" class="class btn btn-warning">Penggunaan</a>
					<a href="pembayaran.php" class="class btn btn-warning">Pembayaran</a>
					<a href="tagihan.php" class="class btn btn-warning">Tagihan</a>
					<a href="hapus.php?login=<?= $_SESSION['login']; ?>" class="class btn btn-warning">Logout</a>
					</div>
						<?php elseif($_SESSION['level'] == '2'): ?>
							<a href="tarif.php" class="class btn btn-warning">Tarif</a>
							<a href="pelanggan.php" class="class btn btn-warning">Pelanggan</a>
							<?php elseif($_SESSION['level'] == '1'): ?>
								<a href="pelanggan.php" class="class btn btn-warning">Pelanggan</a>
								<a href="penggunaan.php" class="class btn btn-warning">Penggunaan</a>
								<a href="pembayaran.php" class="class btn btn-warning">Pembayaran</a>
								<?php elseif($_SESSION['level'] == '0'): ?>
									<a href="pelanggan.php" class="class btn btn-warning">Pelanggan</a>
								<?php endif ?>
							</nav>
							<p style="color: silver">&copy;PLN 123</p>
						</div>
						<div id="wrapper" class="right">