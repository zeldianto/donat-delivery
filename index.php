<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./images/favico.png">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <title>Donat OMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
</head>

<body>
    <div class="flex items-center justify-center mt-5">
        <a href="index.php">
            <img class="logo align-center" src="./images/logo-oma.png" alt="">
        </a>
    </div>
    <div class="text-center pt-6">
        <h2 id="date" class="text-md"></h2>
        <h4 id="time" class="text-lg mt-2 font-bold"></h4>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 p-1">
        <div class="bg-green-500 shadow-md rounded-lg p-4 h-24 flex items-center justify-center cursor-pointer hover:bg-green-600"
            id="deliveryLink">
            <h2 class="text-white text-lg">Pengantaran</h2>
        </div>
        <div class="bg-blue-500 shadow-md rounded-lg p-4 h-24 flex items-center justify-center cursor-pointer hover:bg-blue-600"
            id="pickupLink">
            <h2 class="text-white text-lg">Penjemputan</h2>
        </div>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-3 gap-4 mt-2 p-1">
        <div class="bg-pink-400 rounded-lg p-2 text-center">
            <h3 class="text-white">Terlambat</h3>
            <h1 class="text-white text-2xl font-bold" id="pastDue">0</h1>
        </div>
        <div class="bg-pink-400 rounded-lg p-2 text-center">
            <h3 class="text-white">Hari ini</h3>
            <h1 class="text-white text-2xl font-bold" id="today">0</h1>
        </div>
        <div class="bg-pink-400 rounded-lg p-2 text-center">
            <h3 class="text-white">Besok</h3>
            <h1 class="text-white text-2xl font-bold" id="tomorrow">0</h1>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 mt-2 p-1">
        <div class="bg-gray-500 shadow-md rounded-lg p-4 h-24 flex items-center justify-center cursor-pointer hover:bg-gray-600"
            id="prepareLink">
            <h2 class="text-white text-lg">Persiapan Pembuatan Donat</h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2 p-1">
        <div class="bg-gray-500 shadow-md rounded-lg p-4 h-24 flex items-center justify-center cursor-pointer hover:bg-gray-600"
            id="reportLink">
            <h2 class="text-white text-lg">Laporan Penjualan</h2>
        </div>
        <div class="bg-gray-500 shadow-md rounded-lg p-4 h-24 flex items-center justify-center cursor-pointer hover:bg-gray-600"
            id="outletLink">
            <h2 class="text-white text-lg">Laporan Outlet</h2>
        </div>
    </div>
</body>

<script src="./js/index.js"></script>

</html>