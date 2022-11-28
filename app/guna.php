<?php
function penggunaan_all(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan";
	$result = mysqli_query($link, $query);
	return $result;
}
function penggunaan_meter($meter){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE no_meter='$meter' ORDER BY penggunaan.id_penggunaan DESC";
	$result = mysqli_query($link, $query);
	return $result;
}
function penggunaan_meter_bln($meter,$bln,$thn){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE no_meter='$meter' AND bulan='$bln' AND tahun='$thn'";
	$result = mysqli_query($link, $query);
	return $result;
}
function hapus_penggunaan($id){
	global $link;
	$query = "DELETE FROM penggunaan WHERE id_penggunaan='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function select_guna_meter(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT no_meter FROM penggunaan GROUP BY no_meter";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_akhir_meter($meter){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE penggunaan.no_meter='$meter' ORDER BY penggunaan.id_penggunaan DESC LIMIT 1";
	$result = mysqli_query($link, $query);
	return $result;
}
function cek_penggunaan($meter){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan WHERE no_meter='$meter' ORDER BY id_penggunaan DESC LIMIT 1";
	$result = mysqli_query($link, $query);
	if ($result = mysqli_query($link, $query)) {
		if (mysqli_num_rows($result) == 0) return true;
		else return false;
	}
}
function input_meter_akhir($meter,$bulan,$tahun,$awal,$akhir){
	global $link;
	$akhir = mysqli_real_escape_string($link, $akhir);
	$query = "INSERT INTO penggunaan(no_meter, bulan, tahun, meter_awal, meter_akhir) VALUES('$meter', '$bulan', '$tahun', '$awal', '$akhir')";
	//die($query);
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function update_penggunaan($id,$akhir){
	global $link;
	$query = "UPDATE penggunaan SET meter_akhir='$akhir' WHERE id_penggunaan='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
?>