<?php
include('db.php');  // Koneksi ke database

header('Content-Type: application/json');

// Query untuk mengambil data dari tabel delivery dan outlet
$sql = "SELECT d.id, d.delivery_date, d.pickup_date, d.qty, o.name as outlet_name, o.address 
        FROM delivery d 
        JOIN outlet o ON d.id_outlet = o.id 
        WHERE d.total_income IS NULL OR d.total_income = 0 AND o.is_active = 1
        ORDER BY d.pickup_date ASC";

$result = mysqli_query($koneksi, $sql);

$deliveries = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $deliveries[] = [
            'id' => $row['id'],
            'outlet_name' => $row['outlet_name'],
            'address' => $row['address'],
            'delivery_date' => $row['delivery_date'],
            'pickup_date' => $row['pickup_date'],
            'qty' => $row['qty']
        ];
    }
}

// Mengembalikan data dalam format JSON
echo json_encode($deliveries);
?>