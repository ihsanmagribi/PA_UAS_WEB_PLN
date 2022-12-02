<?php
function login($user,$pass){
	global $link;
	$user = mysqli_real_escape_string($link, $user);
	$pass = mysqli_real_escape_string($link, $pass);
	$query = "SELECT * FROM login WHERE username='$user' AND aktif='1'";
	if ($result = mysqli_query($link,$query)) {
		$test = mysqli_fetch_assoc($result);
		$_SESSION['petugas'] = $test['username'];
		$_SESSION['id_login'] = $test['id_login'];
		$_SESSION['level'] = $test['level'];
		if ($pass == $test['password']) return true;
		else return false;
	}
}
function petugas(){
	global $link;
	$query = "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE level < 5";
	$result = mysqli_query($link, $query);
	return $result;
}
function petugas_pg($halaman_awal, $batas){
	global $link;
	$query = "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE level < 5 limit $halaman_awal, $batas";
	$result = mysqli_query($link, $query);
	return $result;
}
function cek_petugas($user,$id){
	global $link;
	$user = mysqli_real_escape_string($link, $user);
	$query = "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE username='$user' AND aktif='$id'";
	if ($result = mysqli_query($link, $query)){
		if (mysqli_num_rows($result) == 0) return true;
		else return false;
	}
}
function cari_petugas($user){
	global $link;
	$meter = mysqli_real_escape_string($link, $user);
	$query = "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE username='$user'";
	$result = mysqli_query($link, $query);
	return $result;
}
function petugas_where($id){
	global $link;
	$query = "SELECT * FROM login WHERE id_login='$id'";
	$result = mysqli_query($link, $query);
	return $result;
}
function images_where($id){
	global $link;
	$query = "SELECT * FROM images WHERE id_login='$id'";
	$result = mysqli_query($link, $query);
	return $result;
}
function keaktifan($i){
	if ($i == 0) $aktif = 'Tidak Aktif';
	else $aktif = 'Aktif';
	return $aktif;
}
function tugas($i){
	if ($i == 0) $tugas = 'catat meter';
	elseif ($i == 1) $tugas = 'kasir pembayaran';
	elseif ($i == 2) $tugas = 'operator meter';
	elseif ($i == 3) $tugas = 'admin';
	elseif ($i == 100) $tugas = 'DEWA';
	else $tugas = 'nganggur';
	return $tugas;
}
function petugas_level($lv){
	global $link;
	$query = "SELECT * FROM login INNER JOIN images on login.id_login = images.id_login WHERE level = '$lv'";
	$result = mysqli_query($link, $query);
	return $result;
}
function pengaktifan($id,$tes){
	global $link;
	$query = "UPDATE login SET aktif='$tes' WHERE id_login='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function update_petugas($id,$name,$pass){
	global $link;
	$query = "UPDATE login SET username='$name', password='$pass' WHERE id_login='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function delete_petugas($id){
	global $link;
	$query = "DELETE FROM login WHERE id_login='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function input_petugas($nama,$pass,$lv){
	global $link;
	$nama = mysqli_real_escape_string($link, $nama);
	$pass = mysqli_real_escape_string($link, $pass);
	$query1 = "INSERT INTO login(username,password,level) VALUES('$nama', '$pass', '$lv')";
	if ($result = mysqli_query($link, $query1)) return true;
	else return false;
	}
?>