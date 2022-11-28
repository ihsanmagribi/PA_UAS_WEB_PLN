<?php
function select_pembayar(){
	global $link;
	$query = "SELECT * FROM ((pembayaran INNER JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan) INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter";
	$result = mysqli_query($link, $query);
	return $result;
}

function input_pembayaran($login,$idtghn,$tgl,$badmin,$denda,$tagihan){
	global $link;
	$login = aman($login);
	$idtghn = mysqli_real_escape_string($link, $idtghn);
	$query = "INSERT INTO pembayaran(id_login, id_tagihan, tanggal_bayar, biaya_admin, denda, biaya_tagihan) VALUES('$login', '$idtghn', '$tgl', '$badmin', '$denda', '$tagihan')";
	//die($query);
	if ($result = mysqli_query($link, $query)) return true;
	else return false;
}

function select_pembayar_meter($meter){
	global $link;
	$query = "SELECT * FROM ((pembayaran INNER JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan) INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.no_meter = '$meter' ORDER BY penggunaan.id_penggunaan DESC";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_pembayar_meter_bln($meter,$bln,$thn){
	global $link;
	$query = "SELECT * FROM ((pembayaran INNER JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan) INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.no_meter = '$meter' AND penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagihan_bln($bln,$thn){
	global $link;
	$query = "SELECT * FROM ( tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' AND meter.aktif ='1' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagihan_bln_count($bln,$thn){
	global $link;
	$query = "SELECT COUNT(penggunaan.id_penggunaan) as jum FROM ( tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' AND meter.aktif ='1' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagihan_bln_kwh($bln,$thn){
	global $link;
	$query = "SELECT SUM(tagihan.jumlah_meter) as sum FROM ( tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' AND meter.aktif ='1' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagihan_bln_cek($bln,$thn,$i){
	global $link;
	$query = "SELECT COUNT(penggunaan.id_penggunaan) as jum FROM ( tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE penggunaan.bulan='$bln' AND penggunaan.tahun='$thn' AND meter.aktif ='1' AND tagihan.status='$i' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_all_tagihan(){
	global $link;
	$query = "SELECT * FROM (tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.aktif = '1' ORDER BY `penggunaan`.`tahun`, `penggunaan`.`bulan` ASC ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagih(){
	global $link;
	$query = "SELECT * FROM (tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE tagihan.status = '0' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagih_meter($meter){
	global $link;
	$query = "SELECT * FROM (tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.no_meter = '$meter' AND tagihan.status = '0' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function min_tagih_meter($meter){
	global $link;
	$query = "SELECT MIN(penggunaan.id_penggunaan) as id FROM (tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.no_meter = '$meter' AND tagihan.status = '0' ";
	$result = mysqli_query($link, $query);
	return $result;
}
function select_tagihan($st){
	global $link;
	//$meter = mysqli_real_escape_string($link, $meter);
	$query = "SELECT * FROM ((penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan) INNER JOIN meter ON meter.no_meter = penggunaan.no_meter) INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE penggunaan.id_penggunaan='$st'";
	$result = mysqli_query($link, $query);
	return $result;
}

function select_data_all($meter,$id){
	global $link;
	$query = "SELECT * FROM ((((tarif INNER JOIN meter ON tarif.id_tarif = meter.id_tarif) INNER JOIN penggunaan ON penggunaan.no_meter = meter.no_meter) INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan) INNER JOIN pembayaran ON pembayaran.id_tagihan = tagihan.id_tagihan) INNER JOIN login ON login.id_login = pembayaran.id_login WHERE meter.no_meter = '$meter' AND penggunaan.id_penggunaan = '$id'";
	$result = mysqli_query($link, $query);
	return $result;
}

function hitung_tagihan($tarif,$jumlah){
	$hasil = $jumlah * $tarif;
	return $hasil;
}
// function hitung_denda($id){
// 	global $link;
// 	$query = "";
// }
?>