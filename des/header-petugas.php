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
					<a href="tarif.php" class="button">Tarif</a>
					<a href="petugas.php" class="button">Petugas</a>
					<a href="pelanggan.php" class="button">Pelanggan</a>
					<a href="penggunaan.php" class="button">Penggunaan</a>
					<a href="pembayaran.php" class="button">Pembayaran</a>
					<a href="tagihan.php" class="button">Tagihan</a>
						<?php elseif($_SESSION['level'] == '2'): ?>
							<a href="tarif.php" class="button">Tarif</a>
							<a href="pelanggan.php" class="button">Pelanggan</a>
							<?php elseif($_SESSION['level'] == '1'): ?>
								<a href="pelanggan.php" class="button">Pelanggan</a>
								<a href="penggunaan.php" class="button">Penggunaan</a>
								<a href="pembayaran.php" class="button">Pembayaran</a>
								<?php elseif($_SESSION['level'] == '0'): ?>
									<a href="pelanggan.php" class="button">Pelanggan</a>
								<?php endif ?>
								<a href="hapus.php?login=<?= $_SESSION['login']; ?>" class="button">Logout</a>
							</nav>
							<p style="color: silver">&copy;IndroMamen</p>
						</div>
						<div id="wrapper" class="right">