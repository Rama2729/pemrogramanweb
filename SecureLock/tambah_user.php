<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

if (isset($_POST['simpan'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
                alert('Username sudah digunakan!');
                window.location='tambah_user.php';
              </script>";

    } else {

        mysqli_query($conn, "INSERT INTO users(username,email,password,role)
                             VALUES('$username','$email','$password','$role')");

        echo "<script>
                alert('Data user berhasil ditambahkan');
                window.location='user.php';
              </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah User | SecureLock</title>

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

        <h1>Tambah User</h1>

        <div class="profile">

            <?php echo $_SESSION['username']; ?>

        </div>

    </div>

    <div class="form-box">

        <form method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                required
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >

            <label>Role</label>

            <select name="role">

                <option value="User">User</option>

                <option value="Admin">Admin</option>

            </select>

            <br><br>

            <button
                type="submit"
                name="simpan"
                class="btn btn-success">

                Simpan

            </button>

            <a
                href="user.php"
                class="btn btn-danger">

                Batal

            </a>

        </form>

    </div>

</div>

</body>

</html>