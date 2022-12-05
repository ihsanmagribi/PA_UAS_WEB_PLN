<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="res/logo.png">
    <title>PLN online</title>
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
    <link rel="stylesheet" type="text/css" href="des/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
</head>
<body>
    <header1>
        <nav class="navbar navbar-expand-lg navbar-primary bg-warning">
        <i><img src="res/logo3.png" height="80" width="80"></i>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
            <li class="nav-item active">
                <a class="nav-link" href="#wrapper" onclick="return scrol('wrapper');">Cek Meter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#info" onclick="return scrol('info');">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#saran" onclick="return scrol('saran');">Saran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Petugas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#footer" onclick="return scrol('footer');">Kontak Kami</a>
            </li>
        </ul>
        </div>
        </nav>
    </header1>
    <div id="wrapper" align="center" class="bg-warning">
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
					<td><br><input type="submit" name="cari" value="Cari" class="input btn class btn btn-primary"></td>
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
	<div id="info" align="center" class="bg-warning">
		<p class="text">Informasi Tentang PLN</p>
		<div id="gambar">
			<a href="#info" onclick="prev()" class="foc">Prev</a> 
			<a href="#info" onclick="next()" class="foc">Next</a><br>
			<img src="res/info0.jpg" id="test">
		</div>
	</div>
	<div id="saran" align="center" class="bg-warning">
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
					<td class="d-grid gap-2 col-2 mx-auto"><br><input type="submit" name="kirim" value="Kirim" class="class btn btn-primary"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="footer" align="center">
	<p>&copy;PLN 123</p>
	</div>
</body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="des/home.js"></script>
    <script src="des/msc-script.js"></script>
    <?php if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            } ?>
</html>