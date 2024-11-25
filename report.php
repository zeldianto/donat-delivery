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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Laporan | Donat OMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
</head>

<body>
    <div class="flex items-center justify-center mt-5">
        <a href="index.php">
            <img class="logo align-center" src="./images/logo-oma.png" alt="">
        </a>
    </div>
    <div class="flex items-center justify-between mt-8 gap-4">
        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2" id="btnBack">
            <span class="material-symbols-outlined">
                arrow_back
            </span>
        </button>

        <h1 class="font-bold text-gray-500">Laporan Penjualan</h1>

        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2">
            <span class="material-symbols-outlined">
                filter_alt
            </span>
        </button>
    </div>
    <div class="flex item-center justify-end border border-gray-200 mt-4 mx-2 rounded-lg">
        <div class="p-3 flex gap-4">
            <input type="date" id="date" name="date" class="border border-gray-200 p-2 rounded-lg w-full"
                placeholder="">
            <button id="btnGet"
                class="bg-pink-600 hover:bg-pink-700 text-white font-bold p-1 px-4 border  border-gray-200 rounded-lg w-full">Get</button>
        </div>
    </div>
    <div class="container mx-auto mt-4 mb-16 px-2">
        <div class="text-center">Pilih tanggal, lalu klik tombol "Get"</div>
        <!-- <div class="bg-gray-400 rounded-lg p-2 mt-2">
            <div class="text-white text-center p-2">Kedai Kocan (Permata Balai Gadang III Blok C3)</div>
            <div class="bg-white rounded-lg flex item-center justify-between">
                <div class="text-center p-3">
                    <h4 class="text-sm">Nitip</h4>
                    <h2 class="text-xl font-bold">20</h2>
                </div>
                <div class="text-center p-3">
                    <h4 class="text-sm">Laku</h4>
                    <h2 class="text-xl font-bold">5</h2>
                </div>
                <div class="text-center p-3">
                    <h4 class="text-sm">Sisa</h4>
                    <h2 class="text-xl font-bold">15</h2>
                </div>
            </div>
            <div class="text-center text-white p-3">
                    <h4 class="text-sm">Pendapatan</h4>
                    <h2 class="text-lg font-bold">Rp. 12.000</h2>
                </div>
        </div>
        <div class="bg-gray-400 rounded-lg p-2 mt-2">
            <div class="text-white text-center p-2">Kantin SD Marhamah (Samping STTIND)</div>
            <div class="bg-white rounded-lg flex item-center justify-between">
                <div class="text-center p-3">
                    <h4 class="text-sm">Nitip</h4>
                    <h2 class="text-xl font-bold">20</h2>
                </div>
                <div class="text-center p-3">
                    <h4 class="text-sm">Laku</h4>
                    <h2 class="text-xl font-bold">19</h2>
                </div>
                <div class="text-center p-3">
                    <h4 class="text-sm">Sisa</h4>
                    <h2 class="text-xl font-bold">1</h2>
                </div>
            </div>
            <div class="text-center text-white p-3">
                    <h4 class="text-sm">Pendapatan</h4>
                    <h2 class="text-lg font-bold">Rp. 32.000</h2>
                </div>
        </div>
        <div class="flex item-center justify-between mt-4 mx-2 rounded-lg text-xl font-bold">
            <div>Total Pendapatan</div>
            <div>Rp. 44,000</div>
        </div> -->
    </div>
</body>

<script src="./js/report.js"></script>

</html>