<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: user.php");
    exit;
}

$id = intval($_GET['id']);

$data = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");

if (mysqli_num_rows($data) == 0) {
    header("Location: user.php");
    exit;
}

$user = mysqli_fetch_assoc($data);

if ($user['username'] == "admin") {

    echo "<script>
            alert('Akun Admin utama tidak dapat dihapus.');
            window.location='user.php';
          </script>";

    exit;
}

mysqli_query($conn, "DELETE FROM users WHERE id='$id'");

echo "<script>
        alert('Data user berhasil dihapus.');
        window.location='user.php';
      </script>";
?>