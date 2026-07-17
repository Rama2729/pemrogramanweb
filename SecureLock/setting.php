<?php

session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

$query = mysqli_query($conn,"SELECT * FROM otp_settings LIMIT 1");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['simpan'])){

    $otp_interval = mysqli_real_escape_string($conn,$_POST['otp_interval']);
    $max_attempt = mysqli_real_escape_string($conn,$_POST['max_attempt']);
    $lock_duration = mysqli_real_escape_string($conn,$_POST['lock_duration']);

    mysqli_query($conn,"
    UPDATE otp_settings
    SET
    otp_interval='$otp_interval',
    max_attempt='$max_attempt',
    lock_duration='$lock_duration'
    WHERE id='".$data['id']."'
    ");

    $pesan = "<div class='success'>Pengaturan berhasil disimpan.</div>";

    $query = mysqli_query($conn,"SELECT * FROM otp_settings LIMIT 1");
    $data = mysqli_fetch_assoc($query);

}

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pengaturan OTP</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SecureLock</h2>

<a href="dashboard.php">Dashboard</a>

<a href="user.php">Data User</a>

<a href="otp.php">OTP</a>

<a href="setting.php" class="active">Pengaturan</a>

<a href="access_log.php">Access Log</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<h1>Pengaturan OTP</h1>

</div>

<div class="form-box">

<?php echo $pesan; ?>

<form method="POST">

<label>Interval OTP (Detik)</label>

<input
type="number"
name="otp_interval"
value="<?php echo $data['otp_interval']; ?>"
min="10"
required>

<label>Maksimal Percobaan</label>

<input
type="number"
name="max_attempt"
value="<?php echo $data['max_attempt']; ?>"
min="1"
required>

<label>Durasi Lock (Detik)</label>

<input
type="number"
name="lock_duration"
value="<?php echo $data['lock_duration']; ?>"
min="10"
required>

<br><br>

<button
type="submit"
name="simpan"
class="btn btn-success">

Simpan Pengaturan

</button>

</form>

</div>

</div>

</body>

</html>