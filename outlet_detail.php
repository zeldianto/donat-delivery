<?php
include 'include/db.php';

$id_outlet = isset($_GET['id']) ? $_GET['id'] : 0;

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $geolocation = $_POST['geolocation'];
    $note = $_POST['note'];

    // Update query
    $queryUpdate = "UPDATE outlet SET name = '$name', address = '$address', geolocation = '$geolocation', note = '$note' WHERE id = '$id'";

    // Execute update and handle errors
    $resultUpdate = mysqli_query($koneksi, $queryUpdate);
    if ($resultUpdate) {
        header("Location: outlet_detail.php?id=$id&success=1");
        exit;
    } else {
        $update_error = "Error updating outlet: " . mysqli_error($koneksi);
    }
}

$queryOutlet = "SELECT * FROM outlet WHERE id = '$id_outlet'";
$result = mysqli_query($koneksi, $queryOutlet);
if ($outlet = mysqli_fetch_assoc($result)) {
    $name = $outlet['name'];
    $address = $outlet['address'];
    $geolocation = $outlet['geolocation'];
    $note = $outlet['note'];
    $queryDetail = "SELECT * FROM delivery WHERE id_outlet = '$id_outlet' AND total_income > 0 ORDER BY pickup_date DESC";
    $resultDetail = mysqli_query($koneksi, $queryDetail);
    $resultAnalis = mysqli_query($koneksi, $queryDetail);

    $total_qty = 0;
    $total_sold = 0;

    while ($row = mysqli_fetch_assoc($resultAnalis)) {
        $total_qty += $row['qty'];
        $total_sold += $row['donuts_sold'];
    }

    if ($total_qty > 0) {
        // Hitung Potensi Awal berdasarkan donat yang terjual
        $potensi_awal = ($total_sold / $total_qty) * 100;

        // Hitung Penyesuaian Potensi berdasarkan sisa donat
        $sisa_donat = $total_qty - $total_sold;
        $penyesuaian_potensi = $potensi_awal * (1 - ($sisa_donat / $total_qty));

        // Potensi Final
        $potensi_final = round($penyesuaian_potensi, 2);
    } else {
        $potensi_final = 0; // Jika tidak ada data pengiriman
    }
} else {
    $nama_outlet = "Outlet tidak ditemukan";
    $alamat = "-";
}

function format_rupiah($angka)
{
    return "Rp. " . number_format($angka, 0, ',', '.');
}

function calculate_days($start_date, $end_date)
{
    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $diff = $end - $start;
    return round($diff / (60 * 60 * 24)); // Konversi selisih detik ke hari
}

?>

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

    <title>Outlet | Donat OMA</title>
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

        <h1 class="font-bold text-gray-500">Detail Outlet</h1>

        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2" id="btnShowForm">
            <span class="material-symbols-outlined">
                edit
            </span>
        </button>
    </div>
    <?php if (isset($update_error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $update_error ?>
        </div>
    <?php endif; ?>
    <form id="formEditOutlet" method="post" action="outlet_detail.php">
        <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6 mx-2">
            <div class="sm:col-span-3">
                <input type="hidden" id="id" name="id" value="<?= $id_outlet ?>">
                <input type="text" id="name" name="name" autocomplete="off" autocapitalize="words"
                    class="border border-gray-300 p-2 rounded-lg w-full" value="<?= $name ?>" placeholder="Nama warung">
            </div>
            <div class="sm:col-span-3">
                <input type="text" id="address" name="address" autocomplete="off" autocapitalize="words"
                    class="border border-gray-300 p-2 rounded-lg w-full" value="<?= $address ?>" placeholder="Alamat">
            </div>
            <div class="sm:col-span-3">
                <input type="text" id="geolocation" name="geolocation" autocomplete="off" autocapitalize="words"
                    class="border border-gray-300 p-2 rounded-lg w-full" value="<?= $geolocation ?>" placeholder="Maps">
            </div>
            <div class="sm:col-span-3">
                <input type="text" id="note" name="note" autocomplete="off" autocapitalize="words"
                    class="border border-gray-300 p-2 rounded-lg w-full" value="<?= $note ?>" placeholder="Catatan">
            </div>
            <div class="sm:col-span-3">
                <button type="submit" name="submit"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </div>
    </form>
    <div class="flex items-center justify-between mt-4 gap-4 bg-pink-500 text-white rounded-lg mx-2">
        <div class="py-2 px-4">
            <h3 class="text-lg font-bold"><?= $name ?></h3>
            <div class="text-sm"><?= $address ?></div>
        </div>
        <div class="py-2 px-4">
            <span>Potensi</span>
            <h1 class="text-2xl font-bold"><?= $potensi_final ?>%</h1>
        </div>
    </div>
    <div class="container mx-auto pt-4" style="max-height: calc(100vh - 300px);">
        <div class="overflow-x-auto h-full custom-scrollbar">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Pengantaran</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Penjemputan</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Jarak</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Nitip</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Laku</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Sisa</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultDetail)) { ?>
                        <tr>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= $row['delivery_date'] ?>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= $row['pickup_date'] ?>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= calculate_days($row['delivery_date'], $row['pickup_date']) ?> Hari
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= $row['qty'] ?>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= $row['donuts_sold'] ?>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= ($row['qty'] - $row['donuts_sold']) ?>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <?= format_rupiah($row['total_income']) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="./js/outlet_detail.js"></script>

</html>