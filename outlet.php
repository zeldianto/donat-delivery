<?php
include 'include/db.php';

$query = "SELECT * FROM outlet ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);

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

        <h1 class="font-bold text-gray-500">Outlet</h1>

        <button class="flex item-center text-gray-500 hover:bg-gray-100 rounded p-2">
            <span class="material-symbols-outlined">
                filter_alt
            </span>
        </button>
    </div>
    <div class="container mx-auto py-4">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Nama Outlet</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Status</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-right">Laporan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <!-- <td class="py-2 px-4 border-b text-center"><?= $no++; ?></td> -->
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <div class="font-bold"><?= $row['name']; ?></div>
                                <div class="text-sm"><?= $row['address']; ?></div>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <?php if ($row['is_active'] == '1') { ?>
                                    <span
                                        class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs whitespace-nowrap">Active</span>
                                <?php } else { ?>
                                    <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs whitespace-nowrap">Non
                                        Active</span>
                                <?php } ?>
                            </td>
                            <td class="py-2 px-4 border-b text-right">
                                <a href="outlet_detail.php?id=<?= $row['id']; ?>" class="bg-blue-500 text-white py-1 px-3 rounded">Lihat</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="./js/outlet.js"></script>

</html>