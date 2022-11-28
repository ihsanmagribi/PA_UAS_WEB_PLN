<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="res/logo.png">
	<title>PLN online</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="des/home.css">
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
</head>
<body>
	<header>
		<nav>
			<i><img src="res/logo3.png" height="80" width="80"></i>
			<div align="right">
				<a href="#wrapper" onclick="return scrol('wrapper');">Cek Meter</a>
				<a href="#info" onclick="return scrol('info');">Info</a>
				<a href="#saran" onclick="return scrol('saran');">Saran</a>
				<a href="login.php">Petugas</a>
				<a href="#footer" onclick="return scrol('footer');">Kontak Kami</a>
			</div>
		</nav>
		<div class="clear"></div>
	</header>
	<div id="wrapper" align="center">
		<p class="text">Cek Tagihan dan Penggunaan</p>
		<form action="index.php" method="post">
			<table style="width: 100%;">
				<tr>
					<td colspan="2" align="center" style="background-color: red;">
						
					</td>
				</tr>
				<tr>
					<td align="right"><label class="text">No Meter :</label></td>
					<td><input type="text" name="meter" class="input intext" maxlength="12"></td>
				</tr>
				<tr>
					<td></td>
					<td><br><input type="submit" name="cari" value="Cari" class="input btn"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<br> Note : <br>*Masukkan angka <br>*12 digit <br>*lalu tekan cari <br>*angka dari no meter pln
						<br>*bukan no telepon <br>*ini bukan tempat isi pulsa <br>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="info" align="center">
		<p class="text">Informasi Tentang PLN</p>
		<div id="gambar">
			<a href="#info" onclick="prev()" class="foc">Prev</a> 
			<a href="#info" onclick="next()" class="foc">Next</a><br>
			<img src="res/info0.jpg" id="test">
		</div>
	</div>
	<div id="saran" align="center">
		<p class="text">Kotak Saran</p>
		<form action="#" method="post">
			<table width="800">
				<tr>
					<td class="text" align="right">Nama :</td>
					<td><input type="text" name="nama" class="input intext"></td>
				</tr>
				<tr>
					<td class="text" align="right">Saran :</td>
					<td><input type="text" name="saran" class="input intext"></td>
				</tr>
				<tr>
					<td></td>
					<td class="d-grid gap-2 col-2 mx-auto"><br><input type="submit" name="kirim" value="Kirim" class="class btn btn-warning"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="footer" align="center">
	<p>&copy;PLN 123</p>
	</div>
</body>
<script src="des/home.js"></script>
<script src="des/msc-script.js"></script>
<?php if (isset($_SESSION['error'])) {
						echo $_SESSION['error'];
						unset($_SESSION['error']);
						} ?>
</html>