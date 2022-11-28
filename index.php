<?php
require_once 'app/load.php';

if (isset($_POST['cari'])) {
	header("location: info_meter.php?nometer=" . $_POST['meter']);
} else {
	header("location: home.php");
}


