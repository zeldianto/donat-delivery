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

    <title>Pengantaran | Donat OMA</title>
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

        <h1 class="font-bold text-gray-500">Pengantaran</h1>

        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2">
            <span class="material-symbols-outlined">
                settings
            </span>
        </button>
    </div>
    <form id="deliveryForm" class="mt-5">
        <div class="p-2">
            <label for="date" class="text-sm text-gray-500">Tanggal Pengantaran</label>
            <input type="date" id="date" name="date" class="border border-gray-300 p-2 rounded-lg w-full"
                placeholder="">
        </div>
        <div class="p-2">
            <label for="name" class="text-sm text-gray-500">Nama Warung</label>
            <input type="text" id="name" name="name" autocomplete="off" autocapitalize="words"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="address" class="text-sm text-gray-500">Alamat Warung</label>
            <input type="text" id="address" name="address" autocomplete="off" autocapitalize="words"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="geolocation" class="text-sm text-gray-500">Geolokasi</label>
            <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                <input type="text" id="geolocation" name="geolocation" class="p-2 w-full focus:outline-none"
                    placeholder="">
                <button type="button" onclick="getLocation()"
                    class="bg-pink-500 px-2 text-white hover:bg-pink-600 focus:outline-none whitespace-nowrap">Pin
                    Lokasi</button>
            </div>
        </div>
        <div class="p-2">
            <label for="qty" class="text-sm text-gray-500">Jumlah Pengantaran</label>
            <input type="number" id="qty" name="qty" autocomplete="off"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="note" class="text-sm text-gray-500">Catatan</label>
            <input type="text" id="note" name="note" autocomplete="off"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="Catatan">
        </div>
        <div class="p-2 ">
            <button type="submit" id="submitBtn"
                class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg w-full">
                Simpan
            </button>
        </div>
    </form>
</body>

<script src="./js/delivery.js"></script>
<script src="./js/geolocation.js"></script>

</html>