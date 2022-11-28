<?php 
require_once 'app/load.php';

if (isset($_GET['pnometer'])) {
	if (hapus_meter($_GET['pnometer'])) {
		$meter = $_GET['pnometer'];
		$_SESSION['alert'] = "<script>mscAlert('Nomor meter $meter telah dihapus');</script>";
		header('location: pelanggan.php');
	}
}elseif (isset($_GET['trf'])) {
	if (hapus_tarif($_GET['trf'])) {
		$_SESSION['alert'] = "<script>mscAlert('Tarif Berhasil Dihapus!!');</script>";
		header('location: tarif.php');
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Gagal karena ada pelanggan yang menggunakan tarif ini');</script>";
		header('location: tarif.php');
	}
}elseif (isset($_GET['login'])) {
	session_destroy();
	//$_SESSION['error'] = "<script>mscAlert('Anda telah Logout');</script>";
	header('location: login.php');
}
?>