<?php
include('db.php');

header('Content-Type: application/json');

if ($koneksi->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $koneksi->connect_error]);
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT d.id AS delivery_id, d.delivery_date, d.pickup_date, d.qty, d.price, o.name, o.address, o.geolocation, o.note
            FROM delivery d 
            JOIN outlet o ON d.id_outlet = o.id 
            WHERE d.id = ?";

    $stmt = $koneksi->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($delivery_id, $delivery_date, $pickup_date, $qty, $price, $name, $address, $geolocation, $note);

        if ($stmt->fetch()) {
            echo json_encode([
                'success' => true,
                'delivery_id' => $delivery_id,
                'delivery_date' => $delivery_date,
                'pickup_date' => $pickup_date,
                'geolocation' => $geolocation,
                'note' => $note,
                'name' => $name,
                'address' => $address,
                'qty' => $qty
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
}

$koneksi->close();
?>