<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: payment.html");
    exit();
}

setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian');
$timezone = new DateTimeZone('Asia/Jakarta');
$now = new DateTime('now', $timezone);

$tanggal = strftime('%A, %d %B %Y', $now->getTimestamp());
$waktu = $now->format('H:i:s');

$fullName = isset($_POST['fullname']) ? trim($_POST['fullname']) : 'Guest Member';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '-';
$address  = isset($_POST['address']) ? trim($_POST['address']) : '-';
$orderID  = "SF-" . rand(100000, 999999);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scuderia Ferrari | Official Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0a0a0a; }
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="text-white min-h-screen flex items-center justify-center py-10 px-4">

    <div class="max-w-md w-full bg-[#111] border border-zinc-800 rounded-2xl shadow-2xl p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-[#d4af37]"></div>

        <div class="text-center my-4">
            <span class="font-orbitron text-xs font-bold tracking-widest text-[#e10600]">INVOICE RESMI</span>
            <h1 class="font-orbitron text-xl font-bold tracking-tight mt-1 text-white">SCUDERIA FERRARI</h1>
            <p class="text-[10px] text-zinc-500 uppercase mt-1">Maranello, Italy</p>
        </div>

        <hr class="border-zinc-800 my-4">

        <div class="space-y-2 text-xs text-zinc-400 mb-6">
            <div class="flex justify-between">
                <span>Order ID:</span>
                <span class="font-mono text-white font-bold"><?= $orderID ?></span>
            </div>
            <div class="flex justify-between">
                <span>Tanggal:</span>
                <span class="text-zinc-200"><?= ucfirst($tanggal) ?></span>
            </div>
            <div class="flex justify-between">
                <span>Waktu Pemesanan:</span>
                <span class="text-zinc-200"><?= $waktu ?> WIB</span>
            </div>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-lg p-3 mb-6 text-xs">
            <h4 class="font-orbitron text-[#d4af37] font-bold mb-2 tracking-wide">SHIPPING TARGET</h4>
            <p class="text-white font-semibold mb-1"><?= htmlspecialchars($fullName) ?></p>
            <p class="text-zinc-400 mb-1"><?= htmlspecialchars($email) ?></p>
            <p class="text-zinc-500 italic leading-relaxed"><?= htmlspecialchars($address) ?></p>
        </div>

        <div class="bg-emerald-950/30 border border-emerald-800/50 rounded-lg p-4 text-center mb-6">
            <h2 class="text-emerald-400 font-bold text-sm mb-1 font-orbitron">PURCHASE COMPLETE!</h2>
            <p class="text-zinc-400 text-[11px]">Thank you for your ultimate support. Forza Ferrari!</p>
        </div>

        <div class="space-y-2">
            <button onclick="clearStorageAndRedirect()" class="w-full font-orbitron bg-[#e10600] hover:bg-red-700 text-white font-bold py-3 rounded text-xs tracking-wider transition">
                BACK TO HOME
            </button>
        </div>
    </div>

    <script>
        function clearStorageAndRedirect() {
            localStorage.removeItem('ferrari_cart');
            window.location.href = 'index.html';
        }
    </script>
</body>
</html>