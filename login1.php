<?php require_once 'app/load.php';
if (isset($_SESSION['login'])) {
	header('location: utama.php');
} 
if (isset($_POST['login'])) {
	$user = trim($_POST['petugas']);
	$pass = trim($_POST['pass']);
	if (login($user,$pass)) {
		$_SESSION['login'] = 'on';
		header('location: utama.php');
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Login GAGAL!!');</script>";
		header('location: login1.php');
		die();
	}
}
?>
<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="des/petugas.css">
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
    <link rel="icon" type="image/png" href="res/logo.png">
	<title>Login Petugas</title>
  </head>
  <body>
  <div id="login" align="center">
		<form action="login.php" method="post">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><p class="text1">Login Petugas</p></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="petugas" class="inputext-light" placeholder="Masukkan Nama Petugas" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="pass" class="inputext" placeholder="Password petugas" required></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="home.php" class="class btn btn-primary">Kembali</a>
						<input type="submit" name="login" value="Login" class="class btn btn-primary">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script src="des/msc-script.js"></script>
	<script src="des/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <?php if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
	} ?>
  </body>
</html>