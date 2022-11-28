<?php
require_once 'app/load.php';
//if (!isset($_GET['bln'])) return header('location: tagihan.php');
$bulan = $_GET['bln'];
$tahun = $_GET['thn'];
$mt = select_tagihan_bln($bulan,$tahun);
$jum = mysqli_fetch_assoc(select_tagihan_bln_count($bulan,$tahun))['jum'];
$sum = mysqli_fetch_assoc(select_tagihan_bln_kwh($bulan,$tahun))['sum'];
$sudah = mysqli_fetch_assoc(select_tagihan_bln_cek($bulan,$tahun,'1'))['jum'];
$belum = mysqli_fetch_assoc(select_tagihan_bln_cek($bulan,$tahun,'0'))['jum'];
$rata = $sum / $jum;
$bulan = bulan($_GET['bln']);
if (mysqli_num_rows($mt) == 0) {
	$_SESSION['alert'] = "<script>mscAlert('Tagihan di Bulan $bulan dan Tahun $tahun tidak ada');
	</script>";
	return header('location: tagihan.php');
}
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment;Filename=Data Tagihan Bulan '.$bulan.' Tahun '. $tahun.' .xls');
?> 
<style type="text/css">
	.test {
		height: 100px;
		width: 100px;
		text-decoration: bold;
	}
</style>
<?php
echo "<html>";
echo "<body>";
echo "<table border=1px>";
echo "<tr>";
echo "<td>Data Tagihan</td><td>Bulan</td><td>$bulan</td><td>Tahun $tahun</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Lunas</td><td>: $sudah orang</td><td>Belum lunas</td><td>: $belum orang</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Jumlah Penggunaan</td><td>: $sum KWH</td><td>Rata rata</td><td>: ".(int)$rata." KWH</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=4></td>";
echo "</tr>";
echo "<tr>";
echo "<td>No Meter</td>";
echo "<td>Nama</td>";
echo "<td>Jumlah Penggunaan</td>";
echo "<td>Status</td>";
echo "</tr>";
while ($turn = mysqli_fetch_assoc($mt)) {
	echo "<tr>";
	echo "<td>".$turn['no_meter']."</td>";
	echo "<td>".$turn['pemilik']."</td>";
	echo "<td>".$turn['jumlah_meter']." KWH</td>";
	echo "<td>".status_tagihan($turn['status'])."</td>";
	echo "</tr>";
}
echo "</table>";
echo "</body>";
echo "</html>";
?>