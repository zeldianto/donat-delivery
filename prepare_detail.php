<?php
include 'include/db.php';

$outlets = $_GET['outlets'];
$outlet_array = explode(',', $outlets);

$query = "SELECT o.id as id_outlet, o.name, o.address, o.note, DATE_FORMAT(d.pickup_date, '%d-%m-%Y') as pickup_date, d.qty FROM outlet o LEFT JOIN delivery d ON o.id = d.id_outlet WHERE o.id IN (" . implode(',', $outlet_array) . ") AND d.total_income = 0;";
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
    <style>
        /* .container {
            width: 80mm !important;
            font-size: 10px !important;
            margin: 0;
            padding: 0;
        }

        .print-font {
            font-size: 10px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 2px 4px;
            font-size: 10px !important;
            word-wrap: break-word;
        }

        th {
            font-weight: bold;
            font-size: 10px !important;
        } */

        @media print {
            .container {
                width: 80mm !important;
                font-size: 10px !important;
                margin: 0;
                padding: 0;
            }

            .print-font {
                font-size: 10px !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 2px 4px;
                font-size: 10px !important;
                word-wrap: break-word;
                /* Force long text to wrap */
            }

            th {
                font-weight: bold;
                font-size: 10px !important;
            }

            .no-print {
                display: none;
            }

            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
    </style>

</head>

<body>

    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Outlet</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Jumlah</th>
                        <th class="py-2 px-4 border-b whitespace-nowrap text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalQty = 0;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <div class="font-bold print-font"><?= $row['name']; ?></div>
                                <div class="text-sm print-font"><?= $row['address']; ?></div>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <div class="text-sm print-font"><?= $row['qty']; ?></div>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <div class="text-sm print-font"><?= $row['note']; ?></div>
                            </td>
                        </tr>
                        <?php
                        $totalQty += $row['qty'];
                    } ?>
                </tbody>
                <tfoot class="bg-gray-200">
                    <tr>
                        <td class="py-2 px-4 border-b">
                        </td>
                        <td class="py-2 px-4 border-b">
                            <div class="font-bold"><?= $totalQty; ?></div>
                        </td>
                        <td class="py-2 px-4 border-b">
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-right mt-4 no-print">
            <button onclick="printTable()" class="bg-blue-500 text-white py-2 px-4 rounded">Print</button>
        </div>
    </div>
</body>

<script src="./js/outlet.js"></script>
<script>
    function printTable() {
        window.print();
    }
</script>

</html>