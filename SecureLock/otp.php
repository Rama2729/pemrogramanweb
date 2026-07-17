<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

$query = mysqli_query($conn, "
SELECT
otp_logs.*,
users.username
FROM otp_logs
INNER JOIN users
ON otp_logs.user_id = users.id
ORDER BY otp_logs.generated_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>OTP | SecureLock</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SecureLock</h2>

<a href="dashboard.php">Dashboard</a>

<a href="user.php">Data User</a>

<a href="otp.php" class="active">OTP</a>

<a href="setting.php">Pengaturan OTP</a>

<a href="access_log.php">Access Log</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<h1>OTP Management</h1>

<div class="profile">

<?php echo $_SESSION['username']; ?>

</div>

</div>

<div class="table-box">

<div class="table-header">

<h2>Riwayat OTP</h2>

<div>

<a href="generate.php" class="btn btn-success">

Generate OTP

</a>

<a href="verifikasi.php" class="btn btn-warning">

Verifikasi OTP

</a>

</div>

</div>

<table>

<tr>

<th>No</th>

<th>User</th>

<th>Kode OTP</th>

<th>Dibuat</th>

<th>Kedaluwarsa</th>

<th>Status</th>

</tr>

<?php

$no = 1;

while($data = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['username']; ?></td>

<td><?= $data['otp_code']; ?></td>

<td><?= $data['generated_at']; ?></td>

<td><?= $data['expired_at']; ?></td>

<td><?= $data['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>

</html>