<?php 
require_once 'app/load.php';
require_once 'html2pdf/html2pdf.class.php';
$data = mysqli_fetch_assoc(select_data_all($_GET['meter'],$_GET['id']));
//$html2pdf = new HTML2PDF('P', 'A4', 'en');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
	<style type='text/css'>
	* {
		font-family: Calisto MT;
		margin: 0px;
		padding: 0px;
	}
	#bungkus {
		width: 100%;
		height: auto;
	}
	.left {
		float: left;
	}
	.right {
		float: right;
	}
	.clear {
		clear: both;
	}
	#dalam {
		width: 46%;
		height: auto;
		font-size: 13px;
		margin: 0px 2%;
	}
</style>
</head>
<body>
	<div align='center'>
		<div id='bungkus' align='center'>
			<p style='margin: 0'><b>STRUK PEMBELIAN LISTRIK PRABAYAR</b></p><br>
			<div id='dalam' class='left' align='left'>
				<table>
					<tr>
						<td>NOMOR METER</td>
						<td>: <?= $data['no_meter'] ?></td>
					</tr>
					<tr>
						<td>NAMA</td>
						<td>: <?= strtoupper($data['pemilik']) ?></td>
					</tr>
					<tr>
						<td>NO. TELP</td>
						<td>: <?= $data['telp'] ?></td>
					</tr>
					<tr>
						<td>TARIF / DAYA</td>
						<td>: <?= kd_tarif($data['id_tarif']).'/'.$data['daya'].'VA' ?></td>
					</tr>
					<tr>
						<td>PEMAKAIAN</td>
						<td>: <?= strtoupper(bulan($data['bulan'])).' '.$data['tahun'] ?></td>
					</tr>
					<tr>
						<td>JUMLAH KWH</td>
						<td>: <?= $data['jumlah_meter'].' KWH' ?></td>
					</tr>
				</table>
			</div>
			<div id='dalam' class='right' align='left'>
				<table>
					<tr>
						<td>ADMIN</td>
						<td>: <?= strtoupper($data['username']) ?></td>
					</tr>
					<tr>
						<td>BIAYA ADMIN</td>
						<td>: <?= 'Rp. '.number_format($data['biaya_admin'],2) ?></td>
					</tr>
					<tr>
						<td>DENDA</td>
						<td>: <?= 'Rp. '.number_format($data['denda'],2) ?></td>
					</tr>
					<tr>
						<td>TOTAL TAGIHAN</td>
						<td>: <?= 'Rp. '.number_format($data['biaya_tagihan'],2) ?></td>
					</tr>
					<tr>
						<td>TANGGAL BAYAR</td>
						<td>: <?= $data['tanggal_bayar'] ?></td>
					</tr>
				</table>
			</div>
			<div class='clear'></div>
			<br><p style='margin: 0'>Informasi Hunbungi Call Center 123 Atau Hubungi PLN Terdekat</p><hr><br>
		</div>
	</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>
<?php //$html2pdf->Output('Test.pdf') ?>