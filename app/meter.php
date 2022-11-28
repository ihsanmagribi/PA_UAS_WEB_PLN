<?php

function cari_meter($meter){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif = tarif.id_tarif WHERE no_meter='$meter'";
	$result = mysqli_query($link, $query);
	return $result;
}
function input_meter($meter,$tarif,$nama,$alamat,$telp){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$nama = mysqli_real_escape_string($link, $nama);
	$alamat = mysqli_real_escape_string($link, $alamat);
	$telp = mysqli_real_escape_string($link, $telp);
	$query = "INSERT INTO meter(no_meter, id_tarif, pemilik, alamat, telp) VALUES('$meter', '$tarif', '$nama', '$alamat', '$telp')";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function input_tarif($daya,$harga){
	global $link;
	$daya = mysqli_real_escape_string($link, $daya);
	$harga = mysqli_real_escape_string($link, $harga);
	$query = "INSERT INTO tarif(daya, tarif_kwh) VALUES('$daya', '$harga')";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function update_tarif($id,$daya,$harga){
	global $link;
	$daya = mysqli_real_escape_string($link, $daya);
	$harga = mysqli_real_escape_string($link, $harga);
	$query = "UPDATE tarif SET daya='$daya', tarif_kwh='$harga' WHERE id_tarif='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function hapus_tarif($id){
	global $link;
	$query = "DELETE FROM tarif WHERE id_tarif='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function update_meter($meter,$tarif,$nama,$alamat,$telp){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$nama = mysqli_real_escape_string($link, $nama);
	$alamat = mysqli_real_escape_string($link, $alamat);
	$telp = mysqli_real_escape_string($link, $telp);
	$query = "UPDATE meter SET id_tarif='$tarif', pemilik='$nama', alamat='$alamat', telp='$telp' WHERE no_meter='$meter'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function edit_tarif($id,$daya,$harga){
	global $link;
	$daya = mysqli_real_escape_string($link, $daya);
	$harga = mysqli_real_escape_string($link, $harga);
	$query = "UPDATE tarif SET daya='$daya',tarif_kwh='$harga' WHERE id_tarif='$id'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function meter_tarif(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif = tarif.id_tarif WHERE aktif='1' ORDER BY id_meter ASC ";
	$result = mysqli_query($link, $query);
	return $result;
}
function meter_tarif_off(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif = tarif.id_tarif WHERE aktif='0' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function meter_blnini(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$bln = date('m') - 1;
	$query = "SELECT * FROM (meter INNER JOIN penggunaan ON penggunaan.no_meter = meter.no_meter) INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE penggunaan.bulan = '$bln' AND tagihan.status = '0' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function tarif_all(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM tarif ORDER BY daya ASC";
	$result = mysqli_query($link, $query);
	return $result;
}
function meter_all(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM meter";
	$result = mysqli_query($link, $query);
	return $result;
}
// function meter_belumb($meter){
// 	global $link;
// 	$meter = mysqli_real_escape_string($link, $meter);
// 	$blnini = date('m');
// 	$query = "SELECT * FROM meter INNER JOIN penggunaan ON penggunaan.no_meter = meter.no_meter WHERE bulan ='$blnini' OR ?? ";
// 	$result = mysqli_query($link, $query);
// 	return $result;
// }

function select_tarif($id){
	global $link;
	$query = "SELECT * FROM tarif WHERE id_tarif='$id'";
	$result = mysqli_query($link, $query);
	return $result;
}

function langgan($meter){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT COUNT(bulan) AS bulan FROM penggunaan WHERE no_meter='$meter'";
	$result = mysqli_query($link, $query);
	return $result;
}

function select_bayar($meter,$st){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE meter.no_meter='$meter' AND tagihan.status='$st'";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_bayar_where($meter,$st,$bln,$thn){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE meter.no_meter='$meter' AND tagihan.status='$st' AND penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function tidak_denda($meter,$st){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT MAX(id_tagihan) as id FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE meter.no_meter='$meter' AND tagihan.status='$st'";
	$result = mysqli_query($link, $query);
	return $result;
}

function cek_select_bayar($meter,$st){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE meter.no_meter='$meter' AND tagihan.status='$st'";
	if ($result = mysqli_query($link, $query)) {
		if (mysqli_num_rows($result) >= 2) return true;
		else return false;
	}
}

function max_select_bayar($meter,$st){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT MAX(penggunaan.id_penggunaan) as id FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE meter.no_meter='$meter' AND tagihan.status='$st'";
	$result = mysqli_query($link, $query);
	return $result;
}

function cek_bayar($meter,$st){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan WHERE no_meter='$meter' AND status='$st'";
	if ($result = mysqli_query($link, $query)) {
		if (mysqli_num_rows($result) == 0) return true;
		else return false;
	}
}

function cek_meter($meter,$id){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif = tarif.id_tarif WHERE no_meter='$meter' AND aktif='$id'";
	if ($result = mysqli_query($link, $query)){
		if (mysqli_num_rows($result) == 0) return true;
		else return false;
	}
}
function hapus_meter($meter){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "UPDATE meter SET aktif='0' WHERE no_meter='$meter'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function aktif_meter($meter){
	global $link;
	$meter = mysqli_real_escape_string($link, $meter);
	$query = "UPDATE meter SET aktif='1' WHERE no_meter='$meter'";
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}
function last_id_meter(){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT MAX(id_meter) as id FROM meter";
	$result = mysqli_query($link, $query);
	return $result;
}
