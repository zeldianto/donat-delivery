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

    <title>Penjemputan | Donat OMA</title>
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

        <h1 class="font-bold text-gray-500">Penjemputan</h1>

        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2">
            <span class="material-symbols-outlined">
                filter_alt
            </span>
        </button>
    </div>
    <div class="flex items-center justify-between mt-4 gap-4 bg-green-600 text-white rounded-lg mx-2">
        <div class="py-2 px-4">
            <h3 class="text-lg font-bold" id="name"></h3>
            <p class="text-sm" id="address"></p>
        </div>
        <div class="py-2 px-4">
            <button class="flex item-center text-white-500 bg-green-800 hover:bg-green-900 rounded p-2" id="direction">
                <span class="material-symbols-outlined">
                    directions
                </span>
            </button>
        </div>
    </div>
    <form id="pickupForm" class="mt-1">
        <div class="p-2">
            <label for="note" class="text-sm text-gray-500">Catatan</label>
            <input type="note" id="note" name="note" class="border border-gray-300 p-2 rounded-lg w-full"
                placeholder="">
        </div>
        <div class="p-2">
            <label for="date" class="text-sm text-gray-500">Tanggal Penjemputan</label>
            <input type="date" id="date" name="date" class="border border-gray-300 p-2 rounded-lg w-full"
                placeholder="">
            <input type="number" class="hidden" id="deliveryID" name="deliveryID">
        </div>
        <div class="p-2">
            <label for="qty" class="text-sm text-gray-500">Jumlah Donat</label>
            <input type="number" id="qty" name="qty" autocomplete="off" disabled
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="sisa" class="text-sm text-gray-500">Jumlah Sisa</label>
            <input type="number" id="sisa" name="sisa" autocomplete="off" inputmode="numeric" placeholder="0"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="sold_qty" class="text-sm text-gray-500">Jumlah Donat Terjual</label>
            <input type="number" id="sold_qty" name="sold_qty" readonly autocomplete="off" inputmode="numeric"
                placeholder="0" class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="price" class="text-sm text-gray-500">Harga</label>
            <input type="number" id="price" name="price" autocomplete="off" value="1600" inputmode="numeric"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
        </div>
        <div class="p-2">
            <label for="deposit" class="text-sm text-gray-500">Setoran</label>
            <input type="text" id="deposit" name="deposit" readonly placeholder="Rp. 0"
                class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
            <input type="number" class="hidden" id="depositReal" name="depositReal">
        </div>
        <div class="items-center mt-4 mb-4 border border-pink-600 rounded-lg mx-2">
            <div class="py-2 px-4">
                <h3 class="text-sm text-pink-600 font-bold" id="name">Pengantaran selanjutnya</h3>
            </div>
            <div class="pb-2 px-4">
                <label for="nextQty" class="text-sm text-gray-500">Jumlah Donat</label>
                <input type="number" id="nextQty" name="nextQty" autocomplete="off"
                    class="border border-gray-300 p-2 rounded-lg w-full" placeholder="">
            </div>
            <div class="pb-2 px-4">
                <div class="flex items-center mb-4">
                    <!-- Hidden input to set false when unchecked -->
                    <input type="hidden" name="nonActive" value="false">
                    <input id="nonActive" name="nonActive" type="checkbox" value="true"
                        class="h-4 w-4 accent-pink-600 focus:accent-pink-500 border-gray-300 rounded">
                    <label for="nonActive" class="ml-2 text-sm text-gray-700">
                        Tidak melakukan pengantaran lagi (Penarikan)
                    </label>
                </div>
            </div>
            <div class="p-2 ">
                <button type="button" id="submitBtn"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg w-full">
                    Simpan
                </button>
            </div>
    </form>


</body>

<script src="./js/pickup_detail.js"></script>

</html>