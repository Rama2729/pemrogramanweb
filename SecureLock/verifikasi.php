<?php

session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

$user_id = $_SESSION['id'];

$pesan = "";

if(isset($_POST['verifikasi'])){

    $otp = mysqli_real_escape_string($conn,$_POST['otp']);

    $query = mysqli_query($conn,"
    SELECT *
    FROM otp_logs
    WHERE
    user_id='$user_id'
    AND otp_code='$otp'
    AND status='Valid'
    ORDER BY id DESC
    LIMIT 1
    ");

    if(mysqli_num_rows($query)>0){

        $data = mysqli_fetch_assoc($query);

        if(strtotime($data['expired_at']) >= time()){

            mysqli_query($conn,"
            UPDATE otp_logs
            SET status='Used'
            WHERE id='".$data['id']."'
            ");

            $pesan = "<div class='success'>OTP berhasil diverifikasi.</div>";

        }else{

            mysqli_query($conn,"
            UPDATE otp_logs
            SET status='Expired'
            WHERE id='".$data['id']."'
            ");

            $pesan = "<div class='error'>OTP telah kedaluwarsa.</div>";

        }

    }else{

        $pesan = "<div class='error'>OTP tidak valid.</div>";

    }

}

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verifikasi OTP</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SecureLock</h2>

<a href="dashboard.php">Dashboard</a>

<a href="user.php">Data User</a>

<a href="otp.php" class="active">OTP</a>

<a href="setting.php">Pengaturan</a>

<a href="access_log.php">Access Log</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<h1>Verifikasi OTP</h1>

</div>

<div class="form-box">

<?php echo $pesan; ?>

<form method="POST">

<label>Masukkan Kode OTP</label>

<input
type="text"
name="otp"
maxlength="6"
required
>

<button
type="submit"
name="verifikasi"
class="btn btn-success">

Verifikasi OTP

</button>

</form>

<br>

<a
href="otp.php"
class="btn">

Kembali

</a>

</div>

</div>

</body>

</html>