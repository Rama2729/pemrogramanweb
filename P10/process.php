<?php
require __DIR__ . '/vendor/autoload.php';

use Money\Money;
use Money\Currency;

$hasil = 0;
$jumlahUSD = 0;
$kurs = 18000; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jumlahUSD = floatval($_POST['jumlah']);

  
    $jumlahCent = intval($jumlahUSD * 100);


    $uangUSD = new Money($jumlahCent, new Currency('USD'));

    $hasil = ($uangUSD->getAmount() * $kurs) / 100;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Konversi</title>
</head>
<body>

<h2>Hasil Konversi Mata Uang</h2>

<p><strong>Kurs 2026:</strong> 1 USD = Rp <?php echo number_format($kurs, 0, ',', '.'); ?></p>

<p><strong>Jumlah USD:</strong> <?php echo $jumlahUSD; ?> USD</p>

<p><strong>Total Rupiah:</strong> 
Rp <?php echo number_format($hasil, 0, ',', '.'); ?>
</p>

<br>
<a href="index.php">Kembali</a>

</body>
</html>