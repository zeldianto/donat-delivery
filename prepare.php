<?php
include 'include/db.php';

$query = "SELECT o.id as id_outlet, o.name, o.address, DATE_FORMAT(d.pickup_date, '%d-%m-%Y') as pickup_date FROM outlet o LEFT JOIN delivery d ON o.id = d.id_outlet WHERE o.is_active = 1 AND d.total_income = 0 ORDER BY o.created_at DESC;";
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

    <title>Persiapan | Donat OMA</title>
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

        <h1 class="font-bold text-gray-500">Persiapan</h1>

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
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left"></th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Tgl Jemput</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Nama Outlet</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectedOutlets = array();
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <input type="checkbox" name="selected_outlets[]" value="<?= $row['id_outlet']; ?>">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <?= $row['pickup_date']; ?>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <div class="text-sm"><?= $row['name']; ?></div>
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">
                                <div class="text-sm"><?= $row['address']; ?></div>
                            </td>
                        </tr>
                        <?php
                        $selectedOutlets[] = $row['id_outlet'];
                    } ?>
                </tbody>
            </table>
        </div>
        <form action="prepare_detail.php" method="GET">
            <input type="hidden" name="outlets" id="selectedOutlets">
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg w-full"
                onclick="submitForm()">Lihat Rincian</button>
        </form>
    </div>
</body>

<script src="./js/outlet.js"></script>
<script>
    function submitForm() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const selectedOutlets = Array.from(checkboxes).map(checkbox => checkbox.value).join(',');
        document.getElementById('selectedOutlets').value = selectedOutlets;
    }
</script>

</html>