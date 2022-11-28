<?php require_once 'des/header-petugas.php';
$error = '';
if (isset($_POST['baru'])) {
	$username = trim($_POST['name']);
	$password = trim($_POST['pass']);
	$level = $_POST['level'];
	$query = input_petugas($username,$password,$level);
	if(!empty($_FILES['gambar']['name'])){
		$select = mysqli_query($link,"SELECT * FROM login WHERE username='$username'");
		$result = mysqli_fetch_assoc($select);
		$id = $result['id_login'];
		$nama = $_POST['nama_gambar'];
		$waktu = $_POST['waktu'];
		$gambar = $_FILES['gambar']['name'];
		$x = explode('.',$gambar);
		$ekstensi = strtolower(end($x));
		$gambar_baru = "$nama.$ekstensi";
		$tmp = $_FILES['gambar']['tmp_name'];
		if(move_uploaded_file($tmp,"img/$gambar_baru")){
            $query1 = mysqli_query($link,"INSERT INTO images (id_login,nama_gambar, file) VALUES ($id,'$nama', '$gambar_baru');");
	if ($query && $query1) {
		$_SESSION['alert'] = "<script>mscAlert('Petugas bernama $username ditambahkan');</script>";
		header('location: petugas.php');
		die();
	}else{
		$error = "Ada error";
	}
}
}
}
if (isset($_POST['edit'])) {
	$name = trim($_POST['name']);
	$pass = trim($_POST['pass']);
	$id = $_POST['id'];
	$tableGambar = mysqli_query($link, "SELECT * FROM images WHERE id_login='$id'");
	$rowGambar = mysqli_fetch_array($tableGambar);
	$fileLama = $rowGambar['file'];

	$query = update_petugas($id,$name,$pass);
	if(!empty($_FILES['gambar']['name'])){
		$select = mysqli_query($link,"SELECT * FROM login WHERE username='$username'");
		$result = mysqli_fetch_assoc($select);
		$nama = $_POST['nama_gambar'];
		$gambar = $_FILES['gambar']['name'];
		$x = explode('.',$gambar);
		$ekstensi = strtolower(end($x));
		$gambar_baru = "$nama.$ekstensi";
		$tmp = $_FILES['gambar']['tmp_name'];
		if(move_uploaded_file($tmp,"img/$gambar_baru")){
            $query1 = mysqli_query($link,"UPDATE images SET id_login='$id', nama_gambar='$nama', file='$gambar_baru' WHERE id_login='$id'");
	if ($query && $query1) {
		unlink('img/'.$fileLama);
		$_SESSION['alert'] = "<script>mscAlert('Data di petugas $name telah di ubah');</script>";
		header('location: petugas.php');
		die();
	}else{
		$error = 'Ada Error';
	}
}
	}
}
?>
<div style="margin-top: -20px;">
	<form action="form-petugas.php" enctype="multipart/form-data" method="post">
		<table style="width: 32%;">
			<?php if (!isset($_GET['ptgs'])): ?>
				
			<tr>
				<td colspan="2"><p class="text1" align="center">Form Tambah Petugas</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:<input type="text" name="name" class="inputext" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:<input type="text" name="pass" class="inputext" required></td>
			</tr>
			<tr>
                <td>Nama File</td>
                    <td>:<input type="text" class="inputext" name="nama_gambar" required></td>
                </tr>
                <tr>
                    <td>File</td>
                    <td><input type="file" class="inputext" name="gambar" required></td>
                </tr>
			<tr>
				<td>Tugas</td>
				<td>:
					<select name="level" class="inputext">
						<option value="0">Catat meter</option>
						<option value="1">Kasir pembayaran</option>
						<option value="2">Operator meter</option>
						<option value="3">Admin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><a href="petugas.php" class="class btn btn-primary">Kembali</a></td>
				<td><input type="submit" name="baru" value="Tambah" class="class btn btn-primary"></td>
			</tr>
			<?php else: ?>
				<?php $ptgs = mysqli_fetch_assoc(petugas_where($_GET['ptgs'])); 
					$img = mysqli_fetch_assoc(images_where($_GET['ptgs'])); 
				?>
				<tr>
				<td colspan="2"><p class="text1" align="center">Form Edit Petugas</p></td>
			</tr>
			<tr>
				<td colspan="2"><?= $error; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:<input type="text" name="name" class="inputext" value="<?= $ptgs['username']; ?>" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:<input type="text" name="pass" class="inputext" value="<?= $ptgs['password']; ?>" required>
					<input type="hidden" name="id" value="<?= $ptgs['id_login']; ?>"></td>
			</tr>
			<td>Nama File</td>
                    <td><input type="text" name="nama_gambar" class="inputext" value="<?= $img['nama_gambar']; ?>" required></td>
                </tr>
                <tr>
                    <td>File</td>
                    <td><input type="file" name="gambar" value="<?= $img['file']; ?>" required></td>
                </tr>
			<tr>
				<td><a href="petugas.php" class="class btn btn-primary">Kembali</a></td>
				<td><input type="submit" name="edit" value="Edit" class="class btn btn-primary"></td>
			</tr>
			<?php endif ?>
		</table>
	</form>
</div>
<?php require_once 'des/footer-petugas.php'; ?>