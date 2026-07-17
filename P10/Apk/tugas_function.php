<?php

function hitungSubtotal($harga, $jumlah) {
    return $harga * $jumlah;
}

function hitungDiskon($subtotal, $diskon) {
    return $subtotal * ($diskon / 100);
}

function hitungPajak($nilai) {
    return $nilai * 0.11;
}

function hitungTotal($subtotal, $diskonNominal, $pajak) {
    return $subtotal - $diskonNominal + $pajak;
}

$hasil = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $diskon = $_POST['diskon'];

    $subtotal = hitungSubtotal($harga, $jumlah);
    $diskonNominal = hitungDiskon($subtotal, $diskon);
    $subtotalSetelahDiskon = $subtotal - $diskonNominal;
    $pajak = hitungPajak($subtotalSetelahDiskon);
    $total = hitungTotal($subtotal, $diskonNominal, $pajak);

    $hasil = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Pengelola Produk Toko</title>
</head>
<body>

<h2>Aplikasi Pengelola Produk Toko</h2>

<form method="POST">
    <label>Nama Produk:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Harga Produk:</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Jumlah Barang:</label><br>
    <input type="number" name="jumlah" required><br><br>

    <label>Diskon (%):</label><br>
    <input type="number" name="diskon" required><br><br>

    <button type="submit">Hitung</button>
</form>

<?php if ($hasil): ?>
    <h3>Hasil Perhitungan</h3>
    <p>Nama Produk: <?php echo $nama; ?></p>
    <p>Subtotal: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></p>
    <p>Diskon: Rp <?php echo number_format($diskonNominal, 0, ',', '.'); ?></p>
    <p>Pajak (11%): Rp <?php echo number_format($pajak, 0, ',', '.'); ?></p>
    <p><strong>Total Bayar: Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></p>
<?php endif; ?>

</body>
</html>