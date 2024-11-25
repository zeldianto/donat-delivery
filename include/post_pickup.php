<?php
include('db.php');
header('Content-Type: application/json');

if (isset($_POST['deliveryID'])) {
    // Data
    $id = (int) $_POST['deliveryID'];
    $note = mysqli_real_escape_string($koneksi, $_POST['note']);
    $delivery_date = mysqli_real_escape_string($koneksi, $_POST['date']);
    $pickup_date = mysqli_real_escape_string($koneksi, $_POST['date']);
    $sold_qty = (int) $_POST['sold_qty'];
    $price = (int) $_POST['price'];
    $total_income = isset($_POST['depositReal']) ? (int) $_POST['depositReal'] : 0;
    $next_qty = isset($_POST['nextQty']) ? (int) $_POST['nextQty'] : 0;
    $nonActive = isset($_POST['nonActive']) && $_POST['nonActive'] === 'true';

    if ($sold_qty >= 0 && $price >= 0) {
        // Mulai transaksi
        mysqli_begin_transaction($koneksi);

        try {
            // Update data pada tabel delivery
            $sql_update_delivery = "UPDATE delivery SET pickup_date = '$pickup_date', donuts_sold = $sold_qty, price = $price, total_income = $total_income WHERE id = $id";
            $update_delivery = mysqli_query($koneksi, $sql_update_delivery);

            if (!$update_delivery) {
                throw new Exception('Gagal mengupdate data delivery: ' . mysqli_error($koneksi));
            }

            // Jika nonActive tidak dicentang, insert data baru ke tabel delivery
            if ($nonActive == false) {
                $pickup_date = date('Y-m-d', strtotime('+4 days', strtotime($delivery_date)));
                $sql_insert_delivery = "INSERT INTO delivery (delivery_date, pickup_date, id_outlet, qty, donuts_sold, price, total_income)
                                        SELECT '$delivery_date', '$pickup_date', id_outlet, $next_qty, 0, 0, 0 FROM delivery WHERE id = $id";
                $insert_delivery = mysqli_query($koneksi, $sql_insert_delivery);

                if (!$insert_delivery) {
                    throw new Exception('Gagal menambah data delivery baru: ' . mysqli_error($koneksi));
                }

                $sql_update_outlet = "UPDATE outlet SET note = '$note' WHERE id = (SELECT id_outlet FROM delivery WHERE id = $id)";
                $update_outlet = mysqli_query($koneksi, $sql_update_outlet);

                if (!$update_outlet) {
                    throw new Exception('Gagal mengupdate status outlet: ' . mysqli_error($koneksi));
                }
            } else {
                // Jika nonActive dicentang, update status is_active pada tabel outlet
                $sql_update_outlet = "UPDATE outlet SET is_active = 0 WHERE id = (SELECT id_outlet FROM delivery WHERE id = $id)";
                $update_outlet = mysqli_query($koneksi, $sql_update_outlet);

                if (!$update_outlet) {
                    throw new Exception('Gagal mengupdate status outlet: ' . mysqli_error($koneksi));
                }
            }

            // Commit transaksi
            mysqli_commit($koneksi);
            echo json_encode(['message' => 'Data berhasil diperbarui ke Database!']);

        } catch (Exception $e) {
            // Rollback jika ada error
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