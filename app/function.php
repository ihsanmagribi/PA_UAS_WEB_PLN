<?php
//call all tables
//SELECT * FROM ((((tarif INNER JOIN meter ON tarif.id_tarif = meter.id_tarif) INNER JOIN penggunaan ON penggunaan.no_meter = meter.no_meter) INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan) INNER JOIN pembayaran ON pembayaran.id_tagihan = tagihan.id_tagihan) INNER JOIN login ON login.id_login = pembayaran.id_login WHERE meter.no_meter = 123456789101 AND penggunaan.id_penggunaan = '1'


// function daftar($user, $nama, $pass, $telp, $alamat){
// 	global $link;

// 	$pass = md5($pass);
// 	$user = mysqli_real_escape_string($link, $user);
// 	$nama = mysqli_real_escape_string($link, $nama);
// 	$pass = mysqli_real_escape_string($link, $pass);
// 	$telp = mysqli_real_escape_string($link, $telp);
// 	$alamat = mysqli_real_escape_string($link, $alamat);

// 	$query1 = "INSERT INTO login (username, password) VALUES ('$user', '$pass')";
// 	$query2 = "INSERT INTO user (username, nama, alamat, no_telepon) VALUES ('$user', '$nama', '$alamat', '$telp')";
// 	if ( mysqli_query($link, $query1) ) {
// 		mysqli_query($link, $query2);
// 		return true;
// 	}else{
// 		die($query1 . $query2);
// 		return false;
// 	}
// }

// function cek_user($user){
// 	global $link;
// 	$user = mysqli_real_escape_string($link, $user);
// 	$query = "SELECT * FROM login WHERE username= '$user'";
// 	if ($result = mysqli_query($link, $query)) {
// 		if (mysqli_num_rows($result) == 0) return true;
// 		else return false;
// 	}
// }

// function cek_login($user, $pass, $level){
// 	global $link;
// 	$user = mysqli_real_escape_string($link, $user);
// 	$pass = mysqli_real_escape_string($link, $pass);
// 	$pass = md5($pass);
// 	$query = "SELECT password, level FROM login WHERE username='$user'";
// 	$result = mysqli_query($link, $query);
// 	$paslevel = mysqli_fetch_assoc($result);
// 	if ($pass == $paslevel['password'] and $level == $paslevel['level']){
// 		return true;
// 	}else{
// 		return false;
// 	}
// }

// function judul($n){
// 	$judul = array('Listrik Online', 'Login', 'Login Admin', 'Daftar');
// 	$max = count($judul);
// 	if ($n >= $max or $n < 0) {
// 		$n = '0';
// 	}
// 	return $judul[$n];
// }

function bulan($angka){
	if ($angka >= 13) $angka = 1;
	switch ($angka) {
		case 1 :$bulan = "Januari";break;
		case 2 :$bulan = "Febuari";break;
		case 3 :$bulan = "Maret";break;
		case 4 :$bulan = "April";break;
		case 5 :$bulan = "Mei";break;
		case 6 :$bulan = "Juni";break;
		case 7 :$bulan = "Juli";break;
		case 8 :$bulan = "Agustus";break;
		case 9 :$bulan = "September";break;
		case 10 :$bulan = "Oktober";break;
		case 11 :$bulan = "November";break;
		case 12 :$bulan = "Desember";break;
		default : $bulan = "Error";
	}
	return $bulan;
}
function kd_tarif($id){
	$panjangid = strlen($id);
	if ($panjangid == 1) $kd = "TRF00" . $id;
	elseif ($panjangid == 2) $kd = "TRF0" . $id;
	elseif ($panjangid == 3) $kd = "TRF" . $id;
	return $kd;
}
function status_tagihan($id){
	if ($id == 1) $bayar = 'Sudah bayar';
	else $bayar = 'Belum bayar';
	return $bayar;
}

function aman($str){
	global $link;
	$aman = mysqli_escape_string($link,htmlspecialchars($str));
	return $aman;
}