<?php require_once 'des/header-petugas.php';
if (isset($_GET['hps'])) {
	if (delete_petugas($_GET['hps'])) {
		$_SESSION['alert'] = "<script>mscAlert('Petugas Di telah Hapus');</script>";
		header('location: petugas.php');
		die();
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Petugas ini tidak bisa di hapus');</script>";
		header('location: petugas.php');
		die();
	}
}
if (isset($_GET['aktf'])) {
	$id = $_GET['id'];
	$aktf = $_GET['aktf'];
	if (pengaktifan($id,$aktf)) {
		if ($aktf == 1) $_SESSION['alert'] = "<script>mscAlert('Petugas Di Aktifkan');</script>";
		else $_SESSION['alert'] = "<script>mscAlert('Petugas Di NonAktifkan');</script>";
		header('location: petugas.php');
		die();
	}
}
?>
<div id="atas">
	<div class="left">
	<br><form action="petugas.php" method="get">
		Cari Nama Petugas :<input type="search" name="search" class="inputext" maxlength="12">
		<a href="petugas.php" class="class btn btn-primary">refresh</a>
		</form>
	</div>
	<div class="right"><br><a href="form-petugas.php" class="class btn btn-primary">+Petugas</a></div>
	<div class="clear"></div>
</div>
<div id="badan">
	<table id="data">
		<tr>
			<th>Nama</th>
			<th>Tugas</th>
			<th>Foto Petugas</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		$batas = 3;
		$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
		$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
		$Previous = $halaman - 1;
		$next = $halaman + 1;
			if (isset($_GET['search'])) {
				if (cek_petugas($_GET['search'],'1')) {
					$_SESSION['alert'] = "<script>mscAlert('Nomor Meter Tidak ada atau telah hapus!');
					</script>";
					header('location: pelanggan.php');
					die();
				}else{
					$mt = cari_petugas($_GET['search']);
				}
			}else{
				$mt = petugas_pg($halaman_awal, $batas);
			}
		$baris = petugas();
		$jumlah_data = mysqli_num_rows($baris);
		$total_halaman = ceil($jumlah_data / $batas);
		$data_petugas = mysqli_query($link, "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE level < 5 limit $halaman_awal, $batas");
		$nomor = $halaman_awal+1;
		while($ptgs = mysqli_fetch_array($mt)){
					?>
			<tr>
				<td><?= $ptgs['username']; ?></td>
				<td><?= tugas($ptgs['level']); ?></td>
				<td><img width="60px" src="img/<?=$ptgs['file'];?>" ?></td>
				<td><?= keaktifan($ptgs['aktif']); ?></td>
				<td>
					<a href="form-petugas.php?ptgs=<?= $ptgs['id_login'] ?>" class="class btn btn-primary">Ubah data</a>
					<?php if ($ptgs['aktif'] == 1): ?>
						<a onclick="nonaktif('<?= $ptgs['id_login'] ?>')" class="class btn btn-primary">Nonaktifkan</a>
						<?php else: ?>
							<a onclick="aktif('<?= $ptgs['id_login'] ?>')" class="class btn btn-primary">Aktifkan</a>
						<?php endif ?>
					</td>
				</tr>
			<?php } ?>
		</table>
		<nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
		<?php require_once 'des/footer-petugas.php'; ?>