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

$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");

if (mysqli_num_rows($query) == 0) {
    header("Location: user.php");
    exit;
}

$user = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND id!='$id'");

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
                alert('Username sudah digunakan!');
                window.location='edit_user.php?id=$id';
              </script>";

    } else {

        if (!empty($password)) {

            $password = md5($password);

            mysqli_query($conn, "UPDATE users SET
                username='$username',
                email='$email',
                password='$password',
                role='$role'
                WHERE id='$id'");

        } else {

            mysqli_query($conn, "UPDATE users SET
                username='$username',
                email='$email',
                role='$role'
                WHERE id='$id'");

        }

        echo "<script>
                alert('Data berhasil diperbarui');
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

<title>Edit User | SecureLock</title>

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

        <h1>Edit User</h1>

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
                value="<?php echo $user['username']; ?>"
                required
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?php echo $user['email']; ?>"
                required
            >

            <label>Password Baru</label>

            <input
                type="password"
                name="password"
                placeholder="Kosongkan jika tidak diubah"
            >

            <label>Role</label>

            <select name="role">

                <option value="Admin" <?php if($user['role']=="Admin") echo "selected"; ?>>
                    Admin
                </option>

                <option value="User" <?php if($user['role']=="User") echo "selected"; ?>>
                    User
                </option>

            </select>

            <br><br>

            <button
                type="submit"
                name="update"
                class="btn btn-warning">

                Update

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