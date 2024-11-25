<?php
include('db.php');
header('Content-Type: application/json');

if (isset($_POST['name']) && isset($_POST['date']) && isset($_POST['qty'])) {
    // Data Outlet
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $address = isset($_POST['address']) ? mysqli_real_escape_string($koneksi, $_POST['address']) : '';
    $geolocation = isset($_POST['geolocation']) ? mysqli_real_escape_string($koneksi, $_POST['geolocation']) : '';

    // Data Delivery
    $delivery_date = mysqli_real_escape_string($koneksi, $_POST['date']);
    $qty = (int) $_POST['qty'];
    $donuts_sold = isset($_POST['donuts_sold']) ? (int) $_POST['donuts_sold'] : 0;
    $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;

    if ($name != "" && $qty > 0) {
        // Mulai transaksi
        mysqli_begin_transaction($koneksi);

        try {
            // Insert data ke tabel outlet
            $sql_outlet = "INSERT INTO outlet (name, address, geolocation, is_active) VALUES ('$name', '$address', '$geolocation', 1)";
            $simpan_outlet = mysqli_query($koneksi, $sql_outlet);

            if (!$simpan_outlet) {
                throw new Exception('Gagal menyimpan data outlet: ' . mysqli_error($koneksi));
            }

            // Mendapatkan id_outlet yang baru saja disimpan
            $id_outlet = mysqli_insert_id($koneksi);
            $pickup_date = date('Y-m-d', strtotime('+4 days', strtotime($delivery_date)));

            // Insert data ke tabel delivery
            $sql_delivery = "INSERT INTO delivery (delivery_date, pickup_date, id_outlet, qty, donuts_sold, price) 
                             VALUES ('$delivery_date', '$pickup_date', $id_outlet, $qty, $donuts_sold, $price)";
            $simpan_delivery = mysqli_query($koneksi, $sql_delivery);

            if (!$simpan_delivery) {
                throw new Exception('Gagal menyimpan data delivery: ' . mysqli_error($koneksi));
            }

            // Jika semua operasi berhasil, commit transaksi
            mysqli_commit($koneksi);
            echo json_encode(['message' => 'Data berhasil disimpan ke Database!']);

        } catch (Exception $e) {
            // Jika terjadi error, rollback semua perubahan
            mysqli_rollback($koneksi);
            echo json_encode(['message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['message' => 'Harap isi semua field dengan benar.']);
    }
} else {
    echo json_encode(['message' => 'Harap isi semua field yang diperlukan.']);
}
?>