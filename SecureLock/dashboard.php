<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

$totalUser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$totalDevice = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM devices"));
$totalOTP = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM otp_logs"));
$totalAccess = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM access_logs"));
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | SecureLock</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

    <h2>SecureLock</h2>

    <a href="dashboard.php" class="active">Dashboard</a>

    <a href="user.php">Data User</a>

    <a href="otp.php">OTP</a>

    <a href="setting.php">Pengaturan OTP</a>

    <a href="access_log.php">Access Log</a>

    <a href="logout.php">Logout</a>

</div>

<div class="main">

    <div class="topbar">

        <h1>Dashboard</h1>

        <div class="profile">

            <?php echo $_SESSION['username']; ?>

            (<?php echo $_SESSION['role']; ?>)

        </div>

    </div>

    <div class="welcome">

        <h2>Selamat Datang,
            <?php echo $_SESSION['username']; ?>
        </h2>

        <p>
            Sistem Keamanan Brankas Berbasis OTP
        </p>

    </div>

    <div class="card-container">

        <div class="card">

            <h3>Total User</h3>

            <h1><?php echo $totalUser; ?></h1>

        </div>

        <div class="card">

            <h3>Total Device</h3>

            <h1><?php echo $totalDevice; ?></h1>

        </div>

        <div class="card">

            <h3>Total OTP</h3>

            <h1><?php echo $totalOTP; ?></h1>

        </div>

        <div class="card">

            <h3>Access Log</h3>

            <h1><?php echo $totalAccess; ?></h1>

        </div>

    </div>

    <div class="table-box">

        <h2>Informasi Sistem</h2>

        <table>

            <tr>

                <th>Menu</th>

                <th>Keterangan</th>

            </tr>

            <tr>

                <td>Dashboard</td>

                <td>Menampilkan informasi sistem.</td>

            </tr>

            <tr>

                <td>Data User</td>

                <td>Mengelola data pengguna.</td>

            </tr>

            <tr>

                <td>OTP</td>

                <td>Generate dan verifikasi OTP.</td>

            </tr>

            <tr>

                <td>Pengaturan OTP</td>

                <td>Mengubah interval dan konfigurasi OTP.</td>

            </tr>

            <tr>

                <td>Access Log</td>

                <td>Riwayat aktivitas pengguna.</td>

            </tr>

        </table>

    </div>

</div>

</body>

</html>