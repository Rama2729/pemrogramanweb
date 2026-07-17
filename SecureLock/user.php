<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data User | SecureLock</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

    <h2>SecureLock</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="user.php" class="active">Data User</a>

    <a href="otp.php">OTP</a>

    <a href="setting.php">Pengaturan OTP</a>

    <a href="access_log.php">Access Log</a>

    <a href="logout.php">Logout</a>

</div>

<div class="main">

    <div class="topbar">

        <h1>Data User</h1>

        <div class="profile">

            <?php echo $_SESSION['username']; ?>

        </div>

    </div>

    <div class="table-box">

        <div class="table-header">

            <h2>Daftar User</h2>

            <a href="tambah_user.php" class="btn btn-success">
                Tambah User
            </a>

        </div>

        <table>

            <tr>

                <th>No</th>

                <th>Username</th>

                <th>Email</th>

                <th>Role</th>

                <th>Dibuat</th>

                <th>Aksi</th>

            </tr>

            <?php

            $no = 1;

            while($row = mysqli_fetch_assoc($data)){

            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $row['username']; ?></td>

                <td><?= $row['email']; ?></td>

                <td><?= $row['role']; ?></td>

                <td><?= $row['created_at']; ?></td>

                <td>

                    <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning">
                        Edit
                    </a>

                    <a href="hapus_user.php?id=<?= $row['id']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">

                        Hapus

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>

</html>