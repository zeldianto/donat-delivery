<?php
include('db.php');

header('Content-Type: application/json');

if ($koneksi->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $koneksi->connect_error]);
    exit;
}

// Periksa apakah ada parameter tanggal
if (isset($_GET['date']) && !empty($_GET['date'])) {
    $date = $_GET['date'];

    // Query untuk mendapatkan laporan penjualan berdasarkan tanggal
    $sql = "SELECT o.name AS outlet, o.address, d.qty, d.donuts_sold AS laku, (d.qty - d.donuts_sold) AS sisa, d.total_income AS pendapatan
            FROM delivery d
            JOIN outlet o ON d.id_outlet = o.id
            WHERE d.total_income != 0 AND d.pickup_date = ?";

    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $stmt->bind_result($outlet, $address, $qty, $laku, $sisa, $pendapatan);

        $reports = [];

        while ($stmt->fetch()) {
            $reports[] = [
                'outlet' => $outlet,
                'address' => $address,
                'qty' => $qty,
                'laku' => $laku,
                'sisa' => $sisa,
                'pendapatan' => $pendapatan
            ];
        }

        if (count($reports) > 0) {
            echo json_encode(['success' => true, 'reports' => $reports]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tidak ada laporan untuk tanggal tersebut.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mempersiapkan statement: ' . $koneksi->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Tanggal tidak ditemukan.']);
}

$koneksi->close();
?>