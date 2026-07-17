<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SecureLock</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h1>SecureLock</h1>

        <p>Sistem Keamanan Brankas Berbasis OTP</p>

        <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="gagal"){
                echo "<div class='alert'>Username atau Password salah!</div>";
            }

            if($_GET['pesan']=="logout"){
                echo "<div class='success'>Berhasil Logout.</div>";
            }

            if($_GET['pesan']=="belumlogin"){
                echo "<div class='alert'>Silakan login terlebih dahulu.</div>";
            }
        }
        ?>

        <form action="cek_login.php" method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                required
            >

            <button type="submit">
                Login
            </button>

        </form>

        <div class="login-footer">

            <small>
                SecureLock © 2026
            </small>

        </div>

    </div>

</div>

</body>
</html>