<?php

session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?pesan=belumlogin");
    exit;
}

$user_id = $_SESSION['id'];

mysqli_query($conn, "
UPDATE otp_logs
SET status='Expired'
WHERE user_id='$user_id'
AND status='Valid'
");

$otp = rand(100000, 999999);

$generated = date("Y-m-d H:i:s");

$expired = date("Y-m-d H:i:s", strtotime("+5 minutes"));

$status = "Valid";

mysqli_query($conn, "
INSERT INTO otp_logs
(
user_id,
otp_code,
generated_at,
expired_at,
status
)
VALUES
(
'$user_id',
'$otp',
'$generated',
'$expired',
'$status'
)
");

header("Location: otp.php");

exit;

?>