<?php
$upi_id = "sumantmukherjee66294@ibl";
$owner_name = "Suman Mukherjee";
$amount = "6000";
$note = "Rent Payment";

$upi_url = "upi://pay?pa={$upi_id}&pn=" . urlencode($owner_name) . "&am={$amount}&cu=INR&tn=" . urlencode($note);
$encoded_upi_url = urlencode($upi_url);

$qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$encoded_upi_url}";
?>

<img src="<?= $qr_url ?>" alt="UPI QR Code" width="250" height="250" />
