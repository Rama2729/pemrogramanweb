<?php
$merchandise = [
    [
        "id"    => 1,
        "thumb" => "forza/m1.jpg",
        "title" => "Puma Scuderia Ferrari Jersey",
        "desc"  => "Jersey resmi tim F1 dengan teknologi dryCELL dan logo sponsor lengkap.",
        "price" => 120.00,
        "tag"   => "Official Teamwear"
    ],
    [
        "id"    => 2,
        "thumb" => "forza/m5.jpg",
        "title" => "Ferrari Replica Red Cap",
        "desc"  => "Topi melengkung klasik dengan detail bordir nomor pembalap dan badge Scudetto.",
        "price" => 60.00,
        "tag"   => "Accessories"
    ],
    [
        "id"    => 3,
        "thumb" => "forza/m3.jpg",
        "title" => "Scuderia Ferrari Team Jacket",
        "desc"  => "Jaket tahan angin dan air, cocok untuk mendukung tim di sirkuit saat cuaca dingin.",
        "price" => 180.00,
        "tag"   => "Premium Outerwear"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scuderia Ferrari | Official Merchandise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0a0a0a; }
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="text-white min-h-screen">

    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="font-orbitron text-3xl font-bold text-center mb-2 tracking-wider">
            FERRARI <span class="text-[#e10600]">MERCHANDISE</span>
        </h1>
        <p class="text-center text-gray-500 text-sm mb-12">Equip yourself with the official team gear.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($merchandise as $item): ?>
                <div class="bg-[#111] rounded-xl border border-zinc-800 overflow-hidden shadow-xl transition duration-300 hover:border-[#d4af37]">
                    <img src="<?= $item['thumb'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-56 object-cover">
                    
                    <div class="p-5 flex flex-col justify-between h-52">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-[#d4af37] font-bold block mb-1">
                                <?= htmlspecialchars($item['tag']) ?>
                            </span>
                            <h2 class="font-orbitron font-semibold text-lg mb-2 text-white">
                                <?= htmlspecialchars($item['title']) ?>
                            </h2>
                            <p class="text-zinc-400 text-xs leading-relaxed">
                                <?= htmlspecialchars($item['desc']) ?>
                            </p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-zinc-900 mt-2">
                            <span class="text-xl font-bold text-white">
                                $<?= number_format($item['price'], 2) ?>
                            </span>
                            <button class="btn-primary bg-[#e10600] hover:bg-red-700 text-white text-xs font-bold px-4 py-2.5 rounded transition duration-200"
                                    data-name="<?= htmlspecialchars($item['title']) ?>" 
                                    data-price="<?= $item['price'] ?>">
                                ADD TO CART
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="cart.js"></script>
</body>
</html>