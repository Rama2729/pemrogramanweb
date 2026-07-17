<?php

session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($conn,"
SELECT
access_logs.id,
users.username,
devices.device_name,
access_logs.access_time,
access_logs.status,
access_logs.ip_address
FROM access_logs
INNER JOIN users
ON access_logs.user_id = users.id
INNER JOIN devices
ON access_logs.device_id = devices.id
ORDER BY access_logs.access_time DESC
");

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Access Log</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SecureLock</h2>

<a href="dashboard.php">Dashboard</a>

<a href="user.php">Data User</a>

<a href="otp.php">OTP</a>

<a href="setting.php">Pengaturan</a>

<a href="access_log.php" class="active">Access Log</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<h1>Access Log</h1>

</div>

<table>

<tr>

<th>No</th>

<th>Username</th>

<th>Device</th>

<th>Access Time</th>

<th>Status</th>

<th>IP Address</th>

</tr>

<?php

$no = 1;

while($data = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo htmlspecialchars($data['username']); ?></td>

<td><?php echo htmlspecialchars($data['device_name']); ?></td>

<td><?php echo $data['access_time']; ?></td>

<td><?php echo $data['status']; ?></td>

<td><?php echo htmlspecialchars($data['ip_address']); ?></td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>